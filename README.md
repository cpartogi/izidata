## How to install in local
1.Run git clone 
2.Run composer install
3.Run cp .env.example .env
4.Run php artisan key:generate
5.Run php artisan migrate
6.Run php artisan serve
7.Go to link localhost:8000

## API Documentation
#### Register

```http
  POST /api/v1/auth/register
```

#### Request Parameters in JSON Format
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. |
| `password`      | `string` | **Required**. |

### Example
```http
{
    "email":"email@dks.des",
    "password" : "abc_def",
}
```

#### Login

```http
  POST /api/v1/auth/login
```

#### Request Parameters in JSON Format
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `email`      | `string` | **Required**. |
| `password`      | `string` | **Required**. |

### Example
```http
{
    "email":"email@dks.des",
    "password" : "abc_def",
}
```

#### Quote

```http
  GET /api/v1/quote
```

#### Post Transaction

```http
  POST /api/v1/transaction
```

#### Request Headers
| Header | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `token`      | `string` | **Required**. |

#### Request Parameters in JSON Format
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `trx_id`      | `string` | **Required**. |
| `amount`      | `decimal` | **Required**. |

### Example
```http
{
    "trx_id":"g",
    "amount":1,
}
```

#### Get Transaction

```http
  POST /api/v1/transaction/get
```


#### Request Parameters in JSON Format
| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `page`      | `integer` | **Required**. |

### Example
```http
{
    "page":1
}
```