<?php

    $state = get_query_var('state');
    $city = get_query_var('city');
    $zipcode = get_query_var('zipcode');
    $type = get_query_var('type');

    $URL = '';

    // Check if the state, city, and zipcode exist and build the URL accordingly
    if ($state && $city && $zipcode) {
        // All three exist: state, city, and zipcode
        $URL = "$state/$city/$zipcode/";
    } elseif ($state && $city) {
        // Only state and city exist
        $URL = "$state/$city/";
    } elseif ($state) {
        // Only state exists
        $URL = "$state/";
    } else {
        // None of the parameters exist
        $URL = '/';
    }

    $links = [
        'Internet Providers' => home_url('/internet/' . $URL),
        'TV Providers' => home_url('/tv/' . $URL),
        'Internet & TV Providers' => home_url('/internet-tv/' . $URL),
    ];

    function containsText($string, $matchText) {
        return strpos($string, $matchText) !== false;
    }

?>


<section class="bg-[#6041BB] py-4 shadow-sm border-y border-zinc-400/20 sticky top-0">
    <div class="container mx-auto px-4">
        <div>
            <ul class="flex md:gap-3 gap-1.5 items-center">
                <?php 
                foreach ($links as $label => $href): 
                    // Check if $type is contained in $href
                    $isActive = containsText($href, $type)
                ?>
                    <li>
                        <a class="hover:bg-[#111] hover:text-[#fff] !bg-[#fff] !text-[#6041BB] md:text-base text-xs text-center inline-block w-full font-medium md:px-3 px-1.5 py-1.5 rounded-3xl <?php 
                            // Add the active class if $isActive is true
                            // if ($isActive) {
                            //     echo "!bg-[#fff] !text-[#6041BB]";
                            // } else{
                            //     echo "text-white";
                            // }
                        ?>" href="<?php echo htmlspecialchars($href, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php echo htmlspecialchars($label, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>