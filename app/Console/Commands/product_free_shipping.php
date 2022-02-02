<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class product_free_shipping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:free_shipping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make free shipping null if passed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $products = Product::where('free_shipping', '<', Carbon::today())->get();
        foreach ($products as $product) {
            $product->update(['free_shipping' => null]);
        }
        return Command::SUCCESS;
    }
}
