<?php

namespace App\Console\Commands;

use App\Contracts\Entities\PrizeTypeContract;
use App\Contracts\Entities\UserPrizeContract;
use App\Contracts\PrizeServiceFactoryContract;
use App\Models\UserPrize;
use Illuminate\Console\Command;

class DeliverMoneyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'money:deliver';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deliver money';

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
     * @param  PrizeServiceFactoryContract  $factoryContract
     */
    public function handle(PrizeServiceFactoryContract $factoryContract)
    {
        $priceService = $factoryContract->getPrizeService(PrizeTypeContract::TYPE_MONEY);
        $userPrizes = UserPrize::query()
            ->where(UserPrizeContract::FIELD_TYPE, PrizeTypeContract::TYPE_MONEY)
            ->whereNull(UserPrizeContract::FIELD_DELIVERED)
            ->limit(100)
            ->get()
        ;

        $bar = $this->output->createProgressBar($userPrizes->count());
        $bar->start();
        foreach ($userPrizes as $userPrize) {
            $priceService->deliver($userPrize);
            $bar->advance();
        }
        $bar->finish();

        $this->info(PHP_EOL);
    }
}
