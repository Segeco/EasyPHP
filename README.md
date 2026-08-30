# PHP PDO Database Wrapper

A lightweight and secure object-oriented PHP wrapper for interacting with a database using PDO. This class simplifies common database operations such as fetching data, inserting rows, executing raw SQL, and more.

## 🚀 Features

- Easy connection to databases via PDO  
- Fetch all rows, single rows, or individual values  
- Safe parameter binding to prevent SQL injection  
- Insert data using associative arrays  
- Execute raw SQL or prepared DELETE statements  
- Access underlying PDO connection directly  

## 🛠 Usage

### Initialize the Database

```php
$dsn = 'mysql:host=localhost;dbname=testdb;charset=utf8mb4';
$username = 'root';
$password = 'password';

$db = new Database($dsn, $username, $password);
```

### Fetch All Rows

```php
$users = $db->fetchAll("SELECT * FROM users WHERE status = :status", ['status' => 'active']);
```

### Fetch a Single Row

```php
$user = $db->fetchOne("SELECT * FROM users WHERE id = :id", ['id' => 1]);
```

### Fetch a Single Value

```php
$count = $db->fetchValue("SELECT COUNT(*) FROM users");
```

### Insert Data

```php
$id = $db->insert('users', [
    'name' => 'Alice',
    'email' => 'alice@example.com',
    'status' => 'active'
]);
```

### Execute Raw SQL

```php
$db->executeRaw("CREATE TABLE test (id INT PRIMARY KEY, name VARCHAR(255))");
```

### Delete Rows

```php
$deleted = $db->delete("DELETE FROM users WHERE id = :id", ['id' => 5]);
```

### Access PDO Directly

```php
$pdo = $db->getConnection();
// Use $pdo directly if needed
```

## ✅ Requirements

- PHP 8.0 or higher  

## 📄 License

This project is open source and available under the [MIT License](LICENSE).
