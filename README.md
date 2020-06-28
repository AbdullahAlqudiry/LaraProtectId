# Implement luhn algorithm with laravel model
---

With this package you will able to add luhn algorithm works with laravel model in few steps.

Note that: You can use [implicit model binding](https://laravel.com/docs/master/routing#implicit-binding) too. You don't have to do anything, it works automatically!

Just typehint models and they are automatically resolved:

#### Installation
```bash
composer require alqudiry/lara-protect-id
```

#### let the packget work with your model

Just import the trait file in your model
```php
use Illuminate\Database\Eloquent\Model;
use Alqudiry\LaraProtectId\Traits\LaraProtectId;

class Product extends Model
{
    use LaraProtectId;
}
```

### helper functions

methods:

```php
# native method $product = Product::find($id);
$product = Product::protectFind($id);

# native method $product = Product::findMany($ids);
$product = Product::protectFindMany($ids);

# native method $product = Product::findOrFail($id);
$product = Product::protectFindOrFail($id);

# native method $product = Product::findOrNew($id);
$product = Product::protectFindOrNew($id);
```

Get original id of the model:
```php
echo $product->org_id;
```