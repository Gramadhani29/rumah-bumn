<?php

require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

use App\Models\News;

echo "=== CHECKING NEWS DATA ===\n";
echo "Total News: " . News::count() . "\n\n";

echo "=== ALL NEWS ===\n";
$allNews = News::select('id', 'title', 'status', 'is_featured', 'published_at')->get();
foreach ($allNews as $news) {
    echo "ID: {$news->id}\n";
    echo "Title: {$news->title}\n";
    echo "Status: {$news->status}\n";
    echo "Featured: " . ($news->is_featured ? 'Yes' : 'No') . "\n";
    echo "Published: {$news->published_at}\n";
    echo "---\n";
}

echo "\n=== PUBLISHED NEWS ===\n";
$publishedNews = News::published()->select('id', 'title', 'is_featured')->get();
foreach ($publishedNews as $news) {
    echo "ID: {$news->id} - {$news->title} - Featured: " . ($news->is_featured ? 'Yes' : 'No') . "\n";
}

echo "\n=== FEATURED NEWS ===\n";
$featuredNews = News::published()->featured()->select('id', 'title')->get();
foreach ($featuredNews as $news) {
    echo "ID: {$news->id} - {$news->title}\n";
}