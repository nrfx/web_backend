<?php
abstract class BaseController {
    public function getContext(): array {
        return []; // по умолчанию пустой контекст
    }
    
    abstract public function get();
}