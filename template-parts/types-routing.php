<?php

$state = get_query_var('state');
$city = get_query_var('city');
$zipcode = get_query_var('zipcode');

$URL = "$state/$city/$zipcode/";

if (in_array($_SERVER['SERVER_NAME'], ['127.0.0.1', 'localhost', '::1'])) {
    $links = [
        'Internet Providers' => '/cbl/internet/' . $URL,
        'TV Providers' => '/cbl/tv/' . $URL,
        'Internet and TV Providers' => '/cbl/tv-internet/' . $URL,
        'Landline Providers' => '/cbl/landline/' . $URL,
     ];
} else {
    $links = [
        'Internet Providers' => '/internet/' . $URL,
        'TV Providers' => '/tv/' . $URL,
        'Internet and TV Providers' => '/tv-internet/' . $URL,
        'Landline Providers' => '/landline/' . $URL,
     ];
}

?>



<section class="bg-[#215690] py-4 shadow-sm border-y border-zinc-400/20 sticky top-0">
    <div class="container mx-auto px-4">
        <div>
            <ul class="flex md:gap-3 gap-1.5 items-center">
                <?php foreach ($links as $label => $href): ?>
                    <li>
                        <a class="bg-[#ef9831] hover:bg-[#215690] text-white md:text-base text-xs text-center inline-block w-full font-medium font-[Roboto] md:px-3 px-1.5 py-1.5 rounded-3xl" href="<?php echo $href; ?>">
                            <?php echo $label; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>