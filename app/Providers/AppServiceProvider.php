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

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

   /* public function boot()
    {
       View::composer('*', function ($view) {
        $categories = Category::all();
        $query = request()->input('query');

        //This will only fetch posts that match the search query in their title and paginate them accordingly. 
        //This way, if the query exists on a specific page, it will show up on that page
        $originalPaginator = Post::where('title', 'like', '%'.$query.'%')->paginate(1);

        //This line paginates all posts regardless of the search query.

        $posts = Post::paginate(1);

        $totalPostsCount = Post::count();
        //$totalPostsCount =0;
        $matchingPaginators = collect();
        $highlightedResults = [];
        $totalHighlightedCount = 0;
     
             foreach ($posts as $post) 
             {
                 $highlightedTitle = $post->title;
                 $count = 0;
     
                 // If query is present, highlight the matches in post titles
                 if ($query) 
                 {
                     $highlightedTitle = preg_replace_callback('/('.preg_quote($query).')/i', function($matches){
                         return '<span style="background-color: yellow" class="highlight22">' . $matches[0] . '</span>';
                     }, $post->title, -1, $count);
                 }
     
                 if ($count > 0) {
                     $highlightedResults[] = $highlightedTitle;
                     $totalHighlightedCount += $count;
                     //Posts with matches are added to $matchingPaginators. (posts with highlighted results)
                     $matchingPaginators->add($post);
                 }

            }

            if ($matchingPaginators->isNotEmpty()) 
            {
                $posts = $matchingPaginators->paginate(1);
                //$totalPostsCount = $matchingPaginators->count();
    
            } 
            else 
            {
                // No matching results in any paginator, keep all paginators
                $posts = Post::paginate(1); // Keep all paginators if no matches found
                // $totalPostsCount = Post::count(); // Update total post count accordingly
            } */
     
    /*          $view->with('categories', $categories)
                  ->with('query', $query)
                  ->with('posts', $posts)
                  ->with('highlightedResults', $highlightedResults)
                  ->with('originalPaginator', $originalPaginator)
                  ->with('totalHighlightedCount', $totalHighlightedCount)
                  ->with('totalPostsCount', $totalPostsCount); // Add this line
    
     
         });
     } */  
  
     

        // Decide which paginator to pass to the view based on whether search results were found
       

      /*   public function boot()
        {$query = request()->input('query');

            View::composer('*', function ($view) use ($query) {
                $categories = Category::all();
                $query = request()->input('query');
                $totalPostsCount = Post::count();
        
                // Use a conditional clause to apply the search only if there's a query
                $postsQuery = Post::query();
                if ($query) {
                    $postsQuery = $postsQuery->where('title', 'like', '%' . $query . '%');
                }
                // Paginate the query or search results
                $originalPaginator = $postsQuery->paginate(1);
        
                $highlightedResults = [];
                $totalHighlightedCount = 0;
        
                foreach ($originalPaginator as $post) {
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
        
                // Pass the paginator and other variables to the view
                $view->with([
                    'categories' => $categories,
                    'query' => $query,
                    'posts' => $originalPaginator, // This is the paginator
                    'highlightedResults' => $highlightedResults,
                    'totalHighlightedCount' => $totalHighlightedCount,
                    'totalPostsCount' => $totalPostsCount
                ]);
            });
        }
         */

   /*       public function boot()
         {
        
        View::composer('*', function ($view) 
        {
        $categories = Category::all();
         $query = request()->input('query');
         $originalPaginator = Post::where('title', 'like', '%'.$query.'%')->paginate(1);
         $posts = Post::paginate(1);
         $totalPostsCount = Post::count();$highlightedResults = [];
         $totalHighlightedCount = 0;
         foreach ($posts as $post) {
         $highlightedTitle = $post->title;
         $count = 0;
         if ($query){
         $highlightedTitle = preg_replace_callback('/('.preg_quote($query).')/i', function($matches){
         return '<span style="background-color: yellow" class="highlight22">' . $matches[0] . '</span>';
         }, $post->title, -1, $count);}
         if ($count > 0) {
         $highlightedResults[] = $highlightedTitle;
         $totalHighlightedCount += $count;
         }
         }
         $view->with('categories', $categories)
         ->with('query', $query)
         ->with('posts', $posts)
         ->with('highlightedResults', $highlightedResults)
         ->with('originalPaginator', $originalPaginator)
         ->with('totalHighlightedCount',$totalHighlightedCount)
         ->with('totalPostsCount', $totalPostsCount);
         
        });
    } */  
    
    

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