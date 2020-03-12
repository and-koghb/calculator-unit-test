<!DOCTYPE html>
<html>
    <head>
        <title>Calculator</title>
    </head>
    <body>
        <?php
        $errors = [];
        $lastActionText = '';
        if(isset($_GET['result'])) {
            $resultArray = json_decode(urldecode($_GET['result']), true);
            if(array_key_exists('errors', $resultArray)) {
                $errors = $resultArray['errors'];
                $first = $resultArray['first'];
                $second = $resultArray['second'];
                $operation = $resultArray['operation'];
            } elseif(array_key_exists('data', $resultArray)) {
                if(array_key_exists('result', $resultArray['data'])) {
                    $result = $resultArray['data']['result'];
                }
                if(array_key_exists('actionText', $resultArray['data'])) {
                    $lastActionText = str_replace('plus', '+', $resultArray['data']['actionText']);
                }
            }
        }
        echo $lastActionText;
        ?>
        <form method="post" attribute="post" action="calculate.php">
            <p>First Value:<br />
                <input type="text" name="first" value="<?= isset($first)?$first:'' ?>">
                <br />
                <span class="error"><?= (array_key_exists('first', $errors))?$errors['first']:'' ?></span>
            </p>
            <p>Second Value:<br />
                <input type="text" name="second" value="<?= isset($second)?$second:'' ?>">
                <br />
                <span class="error"><?= (array_key_exists('second', $errors))?$errors['second']:'' ?></span>
            </p>
            <div class="operations">
                <div class="operation">
                    <input type="radio" name="operation" value="add" <?= (isset($operation) && $operation == 'add')?'checked':'' ?>><p>+</p>
                </div>
                <div class="operation">
                    <input type="radio" name="operation" value="subtract" <?= (isset($operation) && $operation == 'subtract')?'checked':'' ?>><p>-</p>
                </div>
                <div class="operation">
                    <input type="radio" name="operation" value="multiply" <?= (isset($operation) && $operation == 'multiply')?'checked':'' ?>><p>x</p>
                </div>
                <div class="operation">
                    <input type="radio" name="operation" value="divide" <?= (isset($operation) && $operation == 'devide')?'checked':'' ?>><p>/</p>
                </div>
            </div>
            <span class="error"><?= (array_key_exists('operation', $errors))?$errors['operation']:'' ?></span>
            <br />
            <button type="submit" name="calculate" value="calculate">Calculate</button>
        </form>
    </body>
    <style>
        .operations > .operation:not(:last-child) {
            float: left;
            margin-right: 25px;
        }
        .error {
            color: red;
            font-size: 11px;
        }
    </style>
</html>