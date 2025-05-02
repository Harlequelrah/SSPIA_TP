<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string|null $description
 * @property string|null $product_used_name
 * @property string|null $product_used_quantity
 * @property \App\Enums\InterventionTypeEnum $intervention_type
 * @property \App\Enums\UnitEnum $unit
 * @property string $intervention_date
 * @property string $user_id
 * @property string $plot_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Plot $plot
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereInterventionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereInterventionType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention wherePlotId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereProductUsedName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereProductUsedQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereUnit($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Intervention withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperIntervention {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property float $area
 * @property string $crop_type
 * @property string $plantation_date
 * @property \App\Enums\StatusEnum $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $user_id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property string|null $latitude
 * @property string|null $longitude
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Intervention> $interventions
 * @property-read int|null $interventions_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereArea($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereCropType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot wherePlantationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plot withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPlot {}
}

namespace App\Models{
/**
 * 
 *
 * @property string $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $phone
 * @property string|null $address
 * @property string $username
 * @property \App\Enums\RoleEnum $role
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $must_change_password
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Intervention> $interventions
 * @property-read int|null $interventions_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Plot> $plots
 * @property-read int|null $plots_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereMustChangePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

