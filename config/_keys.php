<?php
if (env('APP_ENV') == "production") {
    $key = 'pk_live_YoIOdK4KTWoFOMQhsS16mgNS';
    $secret = 'sk_live_bN0GvDX01b2679celfAV5SZN';
    $monthlyGBP = 'price_1JuDstIK1JOCQ0oR2u5BKoec';
    $monthlyUSD = 'price_1JuDsjIK1JOCQ0oR87A6pECC';
    $monthlyEUR = 'price_1JuDsUIK1JOCQ0oRIrg27H8J';
    $annualGBP = 'price_1JuDsHIK1JOCQ0oRzyiw5lML';
    $annualUSD = 'price_1JuDrvIK1JOCQ0oRuC5pl1Pp';
    $annualEUR = 'price_1JuDrFIK1JOCQ0oR7DNmYFUV';
} else {
    $key = 'pk_test_51JmbMzIK1JOCQ0oR4fQ4FmcWB0CIyeLBTVSk2HfT4AcvMopSm6urx1ZkbwF3ATIN8a1FSgT8p0HGJGT8TCp4hve500kMKj3ent';
    $secret = 'sk_test_51JmbMzIK1JOCQ0oRjhZlAZLl50hxbBqjJWYjugvHFjRejhqWyLoVsyFBOf7eO8hDE9XeDXElkMyMNzqFq2rUbBaO00WsSGqR23';
    $monthlyGBP = 'price_1JuDv3IK1JOCQ0oR7k2q2Bj4';
    $monthlyUSD = 'price_1JuDujIK1JOCQ0oR4lvaShwz';
    $monthlyEUR = 'price_1JuDucIK1JOCQ0oRchIm9dJs';
    $annualGBP = 'price_1JuDvdIK1JOCQ0oR5DMNYHGz';
    $annualUSD = 'price_1JuDvSIK1JOCQ0oRk5hRGvzE';
    $annualEUR = 'price_1JuDvIIK1JOCQ0oRuVxyx18N';
}
return [
    'monthlyGBP' => $monthlyGBP,
    'monthlyUSD' => $monthlyUSD,
    'monthlyEUR' => $monthlyEUR,
    'annualGBP' => $annualGBP,
    'annualUSD' => $annualUSD,
    'annualEUR' => $annualEUR,
    'STRIPE_KEY' => $key,
    'STRIPE_SECRET' => $secret,
];

