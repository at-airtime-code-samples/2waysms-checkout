<?php
class Driver
{
    function __construct()
    {
        try {
            $DB_host = "localhost";
            $DB_user = "kathure";
            $DB_pass = "K@thure1";
            $DB_name = "2waysms";
            $this->DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
            $this->DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    function checkLevel($session){
        try{
            $stmt=$this->DB_con->prepare("select level from sessionlevels where sessionId =:sLevel");
            $stmt->bindParam(':sLevel',$session);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['level'];
        }catch(Exception $e){
           $e->getMessage();
        }
    }

    function getPhone($session){
        try{
            $stmt=$this->DB_con->prepare("select phonenumber from sessionlevels where sessionId =:session");
            $stmt->bindParam(':session',$session);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)['phonenumber'];
        }catch(Exception $e){
           $e->getMessage();
        }
    }
 
    function insertLevel($sessionId,$phoneNumber,$level){
        try{
            $stmt=$this->DB_con->prepare("INSERT INTO sessionlevels(sessionId,phoneNumber,level) VALUES(:session,:phone,:level)");
            $stmt->bindParam(':session',$sessionId);
            $stmt->bindParam(':phone',$phoneNumber);
            $stmt->bindParam(':level',$level);
            return $stmt->execute();
        }catch (Exception $e){
            $e->getMessage();
        }
    }

    function insertInfo($phoneNumber, $names, $loanTime, $date){
        try{
            $stmt = $this->DB_con->prepare("INSERT INTO userInfo(phonenumber,names,loanTime,regdate) VALUES(:phonenumber,:names,:loanTime,:date)");
            $stmt ->bindParam(':phonenumber',$phoneNumber);
            $stmt ->bindParam(':names',$names);
            $stmt ->bindParam(':loanTime',$loanTime);
            $stmt ->bindParam(':date',$date);
            return $stmt->execute();
        }
        catch(Exception $e){
            $e->getMessage();
        }
    }
   
    function updateLevel($sessionId,$newLevel){
        try{
            $stmt=$this->DB_con->prepare("UPDATE sessionlevels SET level=:level where sessionId=:sessionId");
            $stmt->bindParam(':sessionId',$sessionId);
            $stmt->bindParam(':level',$newLevel);
            return $stmt->execute();
        }catch (Exception $e){
            $e->getMessage();
        }
    }
}