<?php

namespace App\Console\Commands;

use App\Facades\News;
use App\Jobs\ProcessArticle;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('process:articles')]
#[Description('Command description')]
class ProcessArticles extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $articles = News::getArticles();

        foreach ($articles['articles']['results'] as $article) {
            $this->info("Processing article: {$article['title']}");
            ProcessArticle::dispatch($article);
        }
    }
}
