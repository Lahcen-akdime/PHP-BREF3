<?php
class coach extends Person {
    private string $role ;
    private string $style_coach ;
    private string $annee_experience ;
    public function __construct(int $id,string $name,string $email,string $nationality,string $role,int $ValeurMarcher){}
}