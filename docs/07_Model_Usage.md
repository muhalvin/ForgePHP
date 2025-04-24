# Using Models in ForgePHP

1. Create your model:

```bash
php forge create:model Post
```

2. Model file (`app/Models/Post.php`):

```php
namespace App\Models;

use App\Models\BaseModel;

class Post extends BaseModel
{
    public function all()
    {
        return $this->pdo->query("SELECT * FROM posts")->fetchAll();
    }
}
```

3. Use it in your code:

```php
require_once 'config/autoload.php';

use App\Models\Post;

$post = new Post($pdo);
$data = $post->all();
```
