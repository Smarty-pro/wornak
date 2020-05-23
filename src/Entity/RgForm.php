<?php

namespace App\Entity;

class RgForm
{
    protected $CIN;
    protected $password;
    protected $fName;
    protected $lName;
    protected $gender;
    protected $fSituation;
    protected $bDate;
    protected $adress;
    protected $province;
    protected $commune;
    protected $email;
    protected $tel;
    protected $aSituation;
    protected $joblessness;
    protected $mobility;
    protected $handicap;
    protected $handicapNature;
    protected $diplomaType;
    protected $speciality;
    protected $options;
    protected $estabGroup;
    protected $establissement;
    protected $obtentionYear;
    protected $commentary;
    protected $dateDebut;
    protected $dateEnd;
    protected $enterprise;
    protected $jobTitle;
    protected $description;
    protected $language;
    protected $skills;
    protected $liscence;
    protected $activity;
    
    public function getCIN()
    {
        return $this->CIN;
    }

    public function setCIN($CIN)
    {
        $this->CIN = $CIN;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getFName()
    {
        return $this->fName;
    }

    public function setFName($fName)
    {
        $this->fName = $fName;
    }

    public function getLName()
    {
        return $this->lName;
    }  
    
    public function setLName($lName)
    {
        $this->lName = $lName;
    }

    public function getGender()
    {
        return $this->gender;
    }  
    
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getFSituation()
    {
        return $this->fSituation;
    }  
    
    public function setFSituation($fSituation)
    {
        $this->fSituation = $fSituation;
    }

    public function getBDate()
    {
        return $this->bDate;
    }  
    
    public function setBDate($bDate)
    {
        $this->bDate = $bDate;
    }

    public function getAdress()
    {
        return $this->adress;
    }  
    
    public function setAdress($adress)
    {
        $this->adress = $adress;
    }

    public function getProvince()
    {
        return $this->province;
    }  
    
    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function getCommune()
    {
        return $this->commune;
    }  
    
    public function setCommune($commune)
    {
        $this->commune = $commune;
    }

    public function getEmail()
    {
        return $this->email;
    }  
    
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getTel()
    {
        return $this->tel;
    }  
    
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function getASituation()
    {
        return $this->aSituation;
    }  
    
    public function setASituation($aSituation)
    {
        $this->aSituation = $aSituation;
    }

    public function getJoblessness()
    {
        return $this->joblessness;
    }  
    
    public function setJoblessness($joblessness)
    {
        $this->joblessness = $joblessness;
    }

    public function getMobility()
    {
        return $this->mobility;
    }  
    
    public function setMobility($mobility)
    {
        $this->mobility = $mobility;
    }

    public function getHandicap()
    {
        return $this->handicap;
    }  
    
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;
    }

    public function getHandicapNature()
    {
        return $this->handicapNature;
    }  
    
    public function setHandicapNature($handicapNature)
    {
        $this->handicapNature = $handicapNature;
    }

    public function getDiplomaType()
    {
        return $this->diplomaType;
    }  
    
    public function setDiplomaType($diplomaType)
    {
        $this->diplomaType = $diplomaType;
    }

    public function getSpeciality()
    {
        return $this->speciality;
    }  
    
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;
    }

    public function getOptions()
    {
        return $this->options;
    }  
    
    public function setOptions($options)
    {
        $this->options = $options;
    }

    public function getEstabGroup()
    {
        return $this->estabGroup;
    }  
    
    public function setEstabGroup($estabGroup)
    {
        $this->estabGroup = $estabGroup;
    }

    public function getEstablissement()
    {
        return $this->establissement;
    }  
    
    public function setEstablissement($establissement)
    {
        $this->establissement = $establissement;
    }

    public function getObtentionYear()
    {
        return $this->obtentionYear;
    }  
    
    public function setObtentionYear($obtentionYear)
    {
        $this->obtentionYear = $obtentionYear;
    }

    public function getCommentary()
    {
        return $this->commentary;
    }  
    
    public function setCommentary($commentary)
    {
        $this->commentary = $commentary;
    }

    public function getDateDebut()
    {
        return $this->dateDebut;
    }  
    
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }  
    
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    public function getEnterprise()
    {
        return $this->enterprise;
    }  
    
    public function setEnterprise($enterprise)
    {
        $this->enterprise = $enterprise;
    }

    public function getJobTitle()
    {
        return $this->jobTitle;
    }  
    
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    public function getDescription()
    {
        return $this->description;
    }  
    
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getLanguage()
    {
        return $this->language;
    }  
    
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    public function getSkills()
    {
        return $this->skills;
    }  
    
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    public function getLiscence()
    {
        return $this->liscence;
    }  
    
    public function setLiscence($liscence)
    {
        $this->liscence = $liscence;
    }

    public function getActivity()
    {
        return $this->activity;
    }  
    
    public function setActivity($activity)
    {
        $this->activity = $activity;
    }
}