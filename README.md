# Saving a huge file with Symfony

## Create huge file
```bash
php make_huge_file.php
```

## Run project
```bash
cd web
php -S 127.0.0.1:8080 -d upload_max_filesize=250M -d post_max_size=250M
```

## Test
Make sure we are able to receive and save a huge file without using too much memory using PHP.
### Procedure
Using Postman:
* Create a POST request on http://localhost:8080/app.php
* no header
* form-data body:
  * upload huge_file in a "file" field
  * "sha1" field with value "0cf97b4c5cb7bfe2e9a40420a54044539f702033"

### Results:
File saved successfully (both hashes match).
Memory usage around 1.3M.
