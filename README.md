# militer

## Установка
```
composer create-project militer/militer
```

### Какие исключения можно выбросить
```
throw new \Exeption($message [, $code]);
throw new \ErrorExeption($message [, $code]);

throw new (
    BadFunctionCallException
    | BadMethodCallException
    | DomainException
    | InvalidArgumentException
    | LengthException
    | LogicException
    | OutOfBoundsException
    | OutOfRangeException
    | OverflowException
    | RangeException
    | RuntimeException
    | UnderflowException
    | UnexpectedValueException
    )($message [, $code]);
```
