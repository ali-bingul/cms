<?php
    /**
     * @var $exception \Exception
     */

     $this->title = "Error";

?>

<h2 style="color: red; display: flex; justify-content: center;"><?php echo $exception->getCode()?> - <?php echo $exception->getMessage()?></h2>