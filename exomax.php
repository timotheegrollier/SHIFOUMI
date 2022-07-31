for ($i = 1 ; $i < 101; $i++) {
    $res = $i;
    if (is_int($i / 3)) {
        $res = "plop";
        if (is_int($i / 5)) {
            $res = "plip-plop";
        }
    } else if (is_int($i / 5)) {
        $res = "plip";
        if (is_int($i / 3)) {
            $res = "plip-plop";
        }
    }


    echo "<p>" . $res . "</p>";

}
