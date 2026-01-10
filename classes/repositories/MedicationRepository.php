<?php
require_once "BaseRepository.php";

class MedicationRepository extends BaseModel {
    protected string $table = "medications";

    public function GetAllMedication()
    {
        return $this->getUserValue($this->table);
    }
}