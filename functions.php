<?php 
    function render($name, $data)
    {
        $name = 'templates/' . $name;
        $result = '';
    
        if (!file_exists($name)) {
            return $result;
        }
    
        ob_start();
        extract($data);
        require $name;
    
        $result = ob_get_clean();
    
        return $result;
    };

    function price($num)
{
    $price = ceil($num);
    if ($price > 1000) {
        $price = number_format($price, 0, '.', ' ');
    };
    $price = $price . " Р";
    print($price);
};
?>