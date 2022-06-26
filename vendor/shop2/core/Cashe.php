<?php

namespace shop2;

class Cashe
{
    use TSingltone;
    //запис у кеш
    public function set($key, $data, $timelife = 3600)
    {
        if($timelife){
            $content['data'] = $data;
            $content['end_time'] = time() + $timelife;
            if(file_put_contents(CASHE . '/' . md5($key). '.txt', serialize($content))){
                return true;
            }
        }
        return false;
    }
    //отримання з кешу
    public function get($key)
    {
        $file = CASHE . '/' . md5($key) . '.txt';
        if(file_exists($file)){
            $content =unserialize(file_get_contents($file));
            //перевірка не застарілі чи данні
            if(time() <= $content['end_time']){
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }
    // delet cashe
    public function delete($key)
    {
        $file = CASHE . '/' . md5($key) . '.txt';
        if(file_exists($file)){
            unlink($file);
        }
    }

}