# Swivl Test API App

### Requirements

  - PHP >=7.4
  - MySQL >= 5.7
  - Composer >=1.7

### Installation

```sh
$ cd {project-dir}
$ composer install
$ php bin/console d:s:u --force
```
where {project-dir} - directory where is project located.

### Request API Examples

 - Classroom list
   Request [GET]
    ```
    GET {base-url}/api/classroom
    ```
    Response body [200]
    ```
    {
      "count": 3,
      "items": [
        {
          "id": 1,
          "name": "First classroom",
          "active": true,
          "createdAt": "2019-10-12T12:12:12+03:00"
        },
        {
          "id": 2,
          "name": "Second classroom",
          "active": false,
          "createdAt": "2020-09-09T13:17:40+03:00"
        },
        {
          "id": 5,
          "name": "One more classroom",
          "active": true,
          "createdAt": "2020-09-09T13:18:59+03:00"
        }
      ]
    }
    ```
 - Classroom single fetch
   Request [GET]
    ```
    GET {base-url}/api/classroom/{id}
    ```
    Response body [200]
    ```
    {
      "id": 1,
      "name": "First classroom",
      "active": true,
      "createdAt": "2019-10-12T12:12:12+03:00"
    }
    ```
 - Create classroom
   Request [POST]
    ```
    POST {base-url}/api/classroom
    ```
    Request body [JSON]
    ```
    {
      "name": "Some name",
      "active": false
    }
    ``` 
    Response body [200]
    ```
    {
      "id": 6,
      "name": "Some name",
      "active": false,
      "createdAt": "2019-10-12T13:12:12+03:00"
    }
    ```
 - Update classroom
   Request [PATCH]
    ```
    PATCH {base-url}/api/classroom/{id}
    ```
    Request body [JSON]
    ```
    {
      "name": "New name",
    }
    ``` 
    Response body [200]
    ```
    {
      "id": 6,
      "name": "New name",
      "active": false,
      "createdAt": "2019-10-12T13:12:12+03:00"
    }
    ```    
 - Update classroom active status
   Request [PATCH]
    ```
    PATCH {base-url}/api/classroom/{id}/active
    ```
    Request body [JSON]
    ```
    {
      "active": true,
    }
    ``` 
    Response body [200]
    ```
    {
      "id": 6,
      "name": "New name",
      "active": true,
      "createdAt": "2019-10-12T13:12:12+03:00"
    }
    ``` 
 - Delete classroom
   Request [DELETE]
    ```
    DELETE {base-url}/api/classroom/{id}
    ```
    Without request body
    Response without content [204]

 - Classroom list with only names (*It for serialization groups example*)
    
    Request [GET]
    ```
    GET {base-url}/api/classroom/names
    ```
    Response body [200]
    ```
    {
      "count": 3,
      "items": [
        {
          "name": "First classroom",
        },
        {
          "name": "Second classroom",
        },
        {
          "name": "One more classroom",
        }
      ]
    }
    ```
