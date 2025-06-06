# API Documentation

## Products

### List products
- **Method:** GET
- **Route:** /api/products
- **Response example:**
```json
[
  {
    "id": 1,
    "description": "Item 1",
    "price": "10.00",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
]
```

### Create product
- **Method:** POST
- **Route:** /api/products
- **Body fields:**
  - `description` (required, string)
  - `price` (required, decimal with two digits)
- **Request example:**
```json
{
  "description": "Sample",
  "price": "9.99"
}
```
- **Response example:**
```json
{
  "id": 1,
  "description": "Sample",
  "price": "9.99",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Show product
- **Method:** GET
- **Route:** /api/products/{id}
- **Response example:**
```json
{
  "id": 1,
  "description": "Sample",
  "price": "9.99",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Update product
- **Method:** PUT
- **Route:** /api/products/{id}
- **Body fields:**
  - `description` (sometimes required, string)
  - `price` (sometimes required, decimal with two digits)
- **Request example:**
```json
{
  "description": "Updated",
  "price": "19.99"
}
```
- **Response example:**
```json
{
  "id": 1,
  "description": "Updated",
  "price": "19.99",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Delete product
- **Method:** DELETE
- **Route:** /api/products/{id}
- **Response example:**
```json
{}
```

## Customers

### List customers
- **Method:** GET
- **Route:** /api/customers
- **Response example:**
```json
[
  {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
]
```

### Create customer
- **Method:** POST
- **Route:** /api/customers
- **Body fields:**
  - `name` (required, string)
  - `email` (nullable, email)
- **Request example:**
```json
{
  "name": "Sample",
  "email": "sample@example.com"
}
```
- **Response example:**
```json
{
  "id": 1,
  "name": "Sample",
  "email": "sample@example.com",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Show customer
- **Method:** GET
- **Route:** /api/customers/{id}
- **Response example:**
```json
{
  "id": 1,
  "name": "Sample",
  "email": "sample@example.com",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Update customer
- **Method:** PUT
- **Route:** /api/customers/{id}
- **Body fields:**
  - `name` (sometimes required, string)
  - `email` (sometimes nullable, email)
- **Request example:**
```json
{
  "name": "Updated",
  "email": "updated@example.com"
}
```
- **Response example:**
```json
{
  "id": 1,
  "name": "Updated",
  "email": "updated@example.com",
  "created_at": "2024-01-01T00:00:00.000000Z",
  "updated_at": "2024-01-01T00:00:00.000000Z"
}
```

### Delete customer
- **Method:** DELETE
- **Route:** /api/customers/{id}
- **Response example:**
```json
{}
```
