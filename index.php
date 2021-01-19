<?php
  class Persona {
    public $nome;
    public $cognome;
    public $codice_fiscale;
    function __construct($nome,$cognome,$codice_fiscale){
      $this->nome = $nome;
      $this->cognome = $cognome;
      $this->codice_fiscale = $codice_fiscale;
    }
  }

  class Impiegato extends Persona{
    public $cod_impiegato;
    public function __construct($nome,$cognome,$codice_fiscale,$cod_impiegato){
      if ((is_int($nome) || is_int($cognome)) || !is_int($cod_impiegato)) {
        throw new Exception('dati inseriti non corretti');
      }
      parent:: __construct($nome,$cognome,$codice_fiscale);
      $this->cod_impiegato = $cod_impiegato;
    }
    public function calc_salary(){
      return 0;
    }
    public function to_string(){
      echo 'codice Impiegato: ' . $this->cod_impiegato . '<br>';
      echo 'compenso: ' . $this->calc_salary() . '<br>';
      echo 'nome: ' . $this->nome . '<br>';
      echo 'cognome: ' . $this->cognome . '<br>';
      echo 'CF: '. $this->codice_fiscale;
    }
  }

  class ImpiegatoSalariato extends impiegato{
    public $work_day;
    public $salary_day;
    public function __construct($salary_day,$work_day,$nome,$cognome,$codice_fiscale,$cod_impiegato){
      parent:: __construct($nome,$cognome,$codice_fiscale,$cod_impiegato);
      $this->work_day = $work_day;
      $this->salary_day = $salary_day;
    }
    public function calc_salary(){
      return $this->work_day * $this->salary_day;
    }
  }
  class ImpiegatoAOre extends impiegato{
    public $work_hours;
    public $salary_hours;
    public function __construct($salary_hours,$work_hours,$nome,$cognome,$codice_fiscale,$cod_impiegato){
      parent:: __construct($nome,$cognome,$codice_fiscale,$cod_impiegato);
      $this->work_hours = $work_hours;
      $this->salary_hours = $salary_hours;
    }
    public function calc_salary(){
      return $this->work_hours * $this->salary_hours;
    }
  }

  trait Progetto {
    public $project_name;
    public $project_salary;
  }

  class ImpiegatoSuCommisione extends impiegato{
    use Progetto;
    public function __construct($project_name,$project_salary,$nome,$cognome,$codice_fiscale,$cod_impiegato){
      parent:: __construct($nome,$cognome,$codice_fiscale,$cod_impiegato);
      $this->project_name = $project_name;
      $this->project_salary = $project_salary;
    }
    public function calc_salary(){
      return $this->$project_salary;
    }
  }
  $impiegato = new ImpiegatoSalariato(50,30,'carlo','bebo','dcbaucbaucabuubb',99999);
  $impiegato->to_string();
 ?>
