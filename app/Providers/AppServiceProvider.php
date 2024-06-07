<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
      
    }
    
    public function boot()
{
    View::composer('*', function ($view) {
        $categories = Category::all();
        $query = request()->input('query');
        
        // Get paginated results for the original query
        $originalPaginator = Post::where('title', 'like', '%' . $query . '%')->paginate(1);

        // Get all posts
        $posts = Post::paginate(1);
        
        // Count total posts
        $totalPostsCount = Post::count();

        // Initialize an array to store highlighted results
        $highlightedResults = [];
        $totalHighlightedCount = 0;

        // Loop through each post to highlight the search query
        foreach ($posts as $post) {
            $highlightedTitle = $post->title;
            $count = 0;
            if ($query) {
                $highlightedTitle = preg_replace_callback('/('.preg_quote($query).')/i', function($matches) {
                    return '<span style="background-color: yellow" class="highlight22">' . $matches[0] . '</span>';
                }, $post->title, -1, $count);
            }
            if ($count > 0) {
                $highlightedResults[] = $highlightedTitle;
                $totalHighlightedCount += $count;
            }
        }

        // Check if there are any matching results in the original paginator
        $hasOriginalResults = $originalPaginator->total() > 0;

if(!$hasOriginalResults)
{
    $originalPaginator =Post::paginate(1);
}
        $view->with('categories', $categories)
            ->with('query', $query)
            ->with('posts', $posts)
            ->with('highlightedResults', $highlightedResults)
            ->with('originalPaginator',  $originalPaginator )
            ->with('totalHighlightedCount', $totalHighlightedCount)
            ->with('hasOriginalResults', $hasOriginalResults)
            ->with('totalPostsCount', $totalPostsCount);
    });
}




}