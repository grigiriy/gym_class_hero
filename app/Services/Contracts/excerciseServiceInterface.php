<?php

namespace AppServicesContracts;

use AppModelsExercise;
use IlluminateDatabaseEloquentCollection;

interface ExerciseServiceInterface
{
    public function createExercise(array $data) : Exercise;
    public function updateExercise(Exercise $exercise, array $data) : Exercise;
    public function deleteExercise(Exercise $exercise) : bool;
    public function getExerciseById(int $id) : ?Exercise;
    public function getExercisesForUser(int $userId) : Collection;
}