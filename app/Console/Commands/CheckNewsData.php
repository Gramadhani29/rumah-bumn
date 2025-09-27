<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;

class CheckNewsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:news {--clean : Clean sample news data}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check news data in database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if ($this->option('clean')) {
            $this->info('Cleaning sample news...');
            $deleted = News::whereIn('title', ['Sample News 1', 'Sample News 2'])->delete();
            $this->info("Deleted {$deleted} sample news records");
            
            // Make sure only one news is featured
            $featuredCount = News::where('is_featured', true)->count();
            if ($featuredCount > 1) {
                $this->info("Found {$featuredCount} featured news. Setting only the latest as featured...");
                News::where('is_featured', true)->update(['is_featured' => false]);
                News::published()->latest('published_at')->first()->update(['is_featured' => true]);
                $this->info('Fixed featured news');
            }
            return;
        }
        
        $this->info('=== CHECKING NEWS DATA ===');
        $this->info('Total News: ' . News::count());
        
        $this->info('');
        $this->info('=== ALL NEWS ===');
        $allNews = News::select('id', 'title', 'status', 'is_featured', 'published_at')->get();
        foreach ($allNews as $news) {
            $this->line("ID: {$news->id}");
            $this->line("Title: {$news->title}");
            $this->line("Status: {$news->status}");
            $this->line("Featured: " . ($news->is_featured ? 'Yes' : 'No'));
            $this->line("Published: {$news->published_at}");
            $this->line("---");
        }
        
        $this->info('');
        $this->info('=== PUBLISHED NEWS ===');
        $publishedNews = News::published()->select('id', 'title', 'is_featured')->get();
        foreach ($publishedNews as $news) {
            $this->line("ID: {$news->id} - {$news->title} - Featured: " . ($news->is_featured ? 'Yes' : 'No'));
        }
        
        $this->info('');
        $this->info('=== FEATURED NEWS ===');
        $featuredNews = News::published()->featured()->select('id', 'title')->get();
        foreach ($featuredNews as $news) {
            $this->line("ID: {$news->id} - {$news->title}");
        }
    }
}
