<?php
namespace APEX\classes;
use APEX\classes\Person;
use APEX\Trait\search;
use APEX\Trait\crud;
use PDO ;
class coach extends Person {
    private string $style_coach ;
    private string $annee_experience ;
    static private int $P_deplacement = 30;
    private int $salary ;
    private PDO $connection ;
    public $EquipeA ;
    public $EquipeB ;
    private $userId ;
    public function getAnnualCost($Userid,$connection){
    $resault = $connection -> prepare("SELECT salary FROM coach WHERE id = :id");
        $resault->execute([':id'=>$Userid]);
        $data = $resault -> fetchAll(PDO::FETCH_NUM);
        $salary = $data[0][0] ;
    return ($salary * 12) + SELF::$P_deplacement  ;
    }
    use crud;
    use search;
    public function create($name,$email,$nationalite,$style_c,$annes_ex,$salary,$equipe_id,$connection){
        $this -> name = $name ;
        $this -> email = $email ;
        $this -> style_coach = $style_c ;
        $this -> annee_experience = $annes_ex ;
        $this -> nationalite = $nationalite ;
        $this -> connection = $connection;
         try {
            $connection -> beginTransaction();
            $opperation = $connection->prepare("INSERT INTO coach (name,email,nationalite,style_c,annes_ex,salary,equipe_id)
                                      VALUES (:name,:email,:nationalite,:style_c,:annes_ex,:salary,:equipe_id)");
            $opperation -> execute(array(
                ":name" => $this -> name,
                ":email" => $this -> email,
                ":nationalite" => $this -> nationalite,
                ":style_c" =>$this -> style_coach,
                ':annes_ex'=>  intval($this -> annee_experience),
                ':salary' => intval($salary),
                ':equipe_id' => intval($equipe_id)
            ));
            $selectid = $connection -> query("SELECT id FROM coach WHERE name = '$name' AND email = '$email'") ;  
            $id = $selectid -> fetchAll(PDO::FETCH_ASSOC) ;
            $opperation = $connection->prepare("INSERT INTO contrat (coach_id,equipe_id,montant)
                                      VALUES (:coach_id,:equipe_id,:montant)");
            $opperation -> execute(array(
                ':coach_id' => $id[0]['id'],
                ':equipe_id' => intval($equipe_id),
                ':montant' => 10
            ));
            $connection -> commit();
        } catch (\PDOException $e) {
            echo "error : ". $e -> getMessage() ;
            $connection -> rollback();
        }
    }
    public function stocker_et_gitbudget($coachid,$EquipeA, $EquipeB, $connection)
    {
        $this->userId = $coachid;
        $this->EquipeA = $EquipeA;
        $this->EquipeB = $EquipeB;
        $opperation = $connection->prepare("SELECT budget FROM equipe WHERE id = :EquipeB");
        $opperation -> execute([":EquipeB"=>$EquipeB]);
        $budget = $opperation->fetchAll(PDO::FETCH_ASSOC);
        // $budget = $budget[0]['budget'];
        return $budget[0]['budget'];
    }
     public function updateCoachTeam($connection,$equipe_b,$coach_id){
         $connection->prepare("Update joueur SET equipe_id = :equipe_b
                              WHERE id = :id")->execute([':equipe_b' => $equipe_b, ':id' => $coach_id]);
    }
}
$coachClass = new coach ();