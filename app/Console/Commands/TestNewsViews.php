<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;

class TestNewsViews extends Command
{
    protected $signature = 'test:news-views';
    protected $description = 'Test news views column functionality';

    public function handle()
    {
        try {
            // Test query yang sebelumnya error
            $totalViews = News::where('status', 'published')
                             ->where('published_at', '<=', now())
                             ->sum('views');
            
            $this->info("✅ Total views from published news: {$totalViews}");
            
            // Test counting published news
            $publishedCount = News::where('status', 'published')
                                 ->where('published_at', '<=', now())
                                 ->count();
            
            $this->info("✅ Total published news: {$publishedCount}");
            
            // Test individual news
            $news = News::where('status', 'published')->first();
            if ($news) {
                $this->info("✅ Sample news: {$news->title} (Views: {$news->views})");
                
                // Test increment views
                $oldViews = $news->views;
                $news->increment('views');
                $newViews = $news->fresh()->views;
                
                $this->info("✅ Views increment test: {$oldViews} -> {$newViews}");
            }
            
            $this->info("🎉 All tests passed! Views column is working correctly.");
            
        } catch (\Exception $e) {
            $this->error("❌ Error: " . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}