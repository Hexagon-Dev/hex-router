# hex-router
Basic router that works simply by using switch on ``$_SERVER['REQUEST_URI']`` variable.
## Endpoints
| Method | URI | Description |
|----------------|---------|----------------|
| **GET** | /seed | Create and seed table with random data. |
| **GET** | / | Show all posts. |
| **GET** | /show?id=1 | Show certain post. |
