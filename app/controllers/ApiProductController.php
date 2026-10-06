<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');

class ApiProductController extends Controller
{
    public function before_action()
    {
        $this->call->library('api');   // CORS + answers browser preflight (OPTIONS)
        $this->api->require_jwt();     // 401 Unauthorized if the token is missing/invalid
        $this->call->database();
        $this->call->model('ProductModel');
    }

    // GET /api/products
    public function index()
    {
        $this->api->respond(['data' => $this->ProductModel->all()]);
    }

    // GET /api/products/{id}
    public function show($id)
    {
        $this->api->respond(['data' => $this->find_or_404($id)]);
    }

    // POST /api/products
    public function store()
    {
        $clean = $this->validate($this->api->body());

        $id = $this->ProductModel->insert($clean);

        $this->api->respond([
            'message' => 'Product created',
            'data'    => $this->ProductModel->find($id),
        ], 201);
    }

    // PUT or PATCH /api/products/{id}
    public function update($id)
    {
        $existing = $this->find_or_404($id);

        // Fields not sent keep their current value (so PATCH works too)
        $input = array_merge($existing, $this->api->body());
        $clean = $this->validate($input);

        $this->ProductModel->update($id, $clean);

        $this->api->respond([
            'message' => 'Product updated',
            'data'    => $this->ProductModel->find($id),
        ]);
    }

    // DELETE /api/products/{id}
    public function delete($id)
    {
        $this->find_or_404($id);
        $this->ProductModel->delete($id);

        $this->api->respond(['message' => 'Product deleted']);
    }

    private function find_or_404($id)
    {
        $product = $this->ProductModel->find($id);
        if (!$product) {
            $this->api->respond_error('Product not found.', 404);
        }
        return $product;
    }

    /**
     * Validates input and returns clean data, or responds 422.
     * Note: Api::body() HTML-escapes strings, so we decode them back before saving;
     * React escapes text when displaying, so this is safe.
     */
    private function validate(array $in)
    {
        $errors = [];

        $name = trim(html_entity_decode((string)($in['product_name'] ?? ''), ENT_QUOTES, 'UTF-8'));
        $desc = trim(html_entity_decode((string)($in['description'] ?? ''), ENT_QUOTES, 'UTF-8'));

        if ($name === '') {
            $errors['product_name'] = 'Product name is required.';
        } elseif (mb_strlen($name) > 100) {
            $errors['product_name'] = 'Product name must be 100 characters or less.';
        }

        $price = $in['price'] ?? null;
        if (!is_numeric($price) || $price < 0 || $price > 99999999.99) {
            $errors['price'] = 'Price must be a number from 0 to 99999999.99.';
        }

        $qty = filter_var($in['quantity'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);
        if ($qty === false) {
            $errors['quantity'] = 'Quantity must be a whole number, 0 or higher.';
        }

        if ($errors) {
            $this->api->respond([
                'error'  => 'Validation failed',
                'status' => 422,
                'errors' => $errors,
            ], 422);
        }

        return [
            'product_name' => $name,
            'description'  => $desc,
            'price'        => round((float)$price, 2),
            'quantity'     => $qty,
        ];
    }
}
