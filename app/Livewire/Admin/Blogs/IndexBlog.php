<?php
namespace App\Livewire\Admin\Blogs;

use Livewire\Component;

class IndexBlog extends Component
{
    public $blogs = [];

    public function render()
    {
        return view('livewire.admin.blogs.index-blog');
    }
}
