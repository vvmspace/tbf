# Powered by Laravel Zero

Билд лежит в app/builds, нужен php 7.2

## Задача 1

```bash
./tbf isequal {m} {n}
```

### Код:

https://github.com/vvmspace/tbf/blob/master/app/Commands/IsEqualCommand.php

```php

($m == $n) ? 'OK' : 'ERROR'

```


## Задача 2


```bash
./tbf plussort s+t+r+i+n+g
```

### Код:

https://github.com/vvmspace/tbf/blob/master/app/Commands/PlusSortCommand.php


```php
static function PlusSort($s){
	$array = explode('+', $s);
	sort($array);
	return implode('+', $array);
}
```

## Задача 4

```bash
./tbf bindec 47
```

### Код:

```php
    public function handle()
    {
        $n = $this->argument('some47');
        if(!preg_match('/^[47]+$/', $n)) {
            $this->error('Wrong number');
            exit;
        }
        $bin = str_replace([4,7], [0,1], $n);
        $dec = bindec($bin)+1;
        $this->info($dec);
    }
```

https://github.com/vvmspace/tbf/blob/master/app/Commands/BinDecCommand.php


## Задача 5


```bash
./tbf checker input_file.txt output_file.txt
```

### Код:

Для неё собственно и поднимался репозиторий, лучше смотреть код команды целиком:

https://github.com/vvmspace/tbf/blob/master/app/Commands/CheckerCommand.php


## Задача 6

На вход идут две кучки брусков в одиночных кавычках через пробел, количество брусков не нужно:

```bash
./tbf brus '1 3 4 5' '2 3 4 7'
```

### Код:

```php
    static function BCnt($first, $second){
        $n = 0;
        foreach($first as $a){
            $n += count(array_filter($second, function($b) use ($a){
                return ($b == $a + 1) || ($b == $a - 1);
            }));
        }
        return $n;
    }
```

https://github.com/vvmspace/tbf/blob/master/app/Commands/BrusCommand.php
