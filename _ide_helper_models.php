<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AnneeScolaire
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire query()
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AnneeScolaire whereUpdatedAt($value)
 */
	class AnneeScolaire extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classe
 *
 * @property int $id
 * @property string $label
 * @property int $level_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Level $level
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUpdatedAt($value)
 */
	class Classe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Discipline
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline query()
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Discipline whereUpdatedAt($value)
 */
	class Discipline extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DisciplineClasse
 *
 * @property int $id
 * @property float $max_mark
 * @property int $classe_id
 * @property int $discipline_id
 * @property int $evaluation_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $semester_id
 * @property-read \App\Models\Classe $classe
 * @property-read \App\Models\Discipline $discipline
 * @property-read \App\Models\Evaluation $evaluation
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse query()
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereEvaluationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereMaxMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereSemesterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineClasse whereUpdatedAt($value)
 */
	class DisciplineClasse extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Eleve
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $birthdate
 * @property string|null $birthplace
 * @property string $sex
 * @property int $profil
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $state
 * @property int|null $number
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve query()
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereBirthdate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereBirthplace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereProfil($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eleve whereUpdatedAt($value)
 */
	class Eleve extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Evaluation
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Evaluation whereUpdatedAt($value)
 */
	class Evaluation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Inscription
 *
 * @property int $id
 * @property int $annee_scolaire_id
 * @property int $eleve_id
 * @property int $classe_id
 * @property string|null $date
 * @property-read \App\Models\AnneeScolaire $anneeScolaire
 * @property-read \App\Models\Classe $classe
 * @property-read \App\Models\Eleve $eleve
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereAnneeScolaireId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereEleveId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Inscription whereId($value)
 */
	class Inscription extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Level
 *
 * @property int $id
 * @property string $label
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Classe> $classes
 * @property-read int|null $classes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Level newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Level query()
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereLabel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Level whereUpdatedAt($value)
 */
	class Level extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Mark
 *
 * @property int $id
 * @property float $value
 * @property int $discipline_classe_id
 * @property int $inscription_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\DisciplineClasse $disciplineClasse
 * @property-read \App\Models\Inscription $inscription
 * @method static \Illuminate\Database\Eloquent\Builder|Mark newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mark newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Mark query()
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereDisciplineClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereInscriptionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Mark whereValue($value)
 */
	class Mark extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Semester
 *
 * @property int $id
 * @property int $semester_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester query()
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereSemesterNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Semester whereUpdatedAt($value)
 */
	class Semester extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $fullname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

