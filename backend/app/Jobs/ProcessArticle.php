<?php

namespace App\Jobs;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class ProcessArticle implements ShouldQueue
{
    use Queueable;

    private array $article;

    /**
     * Create a new job instance.
     */
    public function __construct(array $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Article::updateOrCreate([
            'title' => $this->article['title'],
        ], [
            'body' => nl2br($this->article['body']),
            'source_uri' => $this->article['source']['uri'],
            'source_title' => $this->article['source']['title'],
            'image' => $this->processImage($this->article['image']),
            'published_at' => $this->article['dateTimePub'],
        ]);
    }

    public function processImage(string $uri): string
    {
        $imageContents = file_get_contents($uri);
        $imageName = basename($uri);

        return Storage::disk('article_images')->put($imageName, $imageContents);
    }
}
