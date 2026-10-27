<?php

namespace App\Modules\Admin\Http\Requests;

use App\Models\Tenant;
use App\Models\UserVenueRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', Tenant::class) ?? false;
    }

    public function venueId(): ?int
    {
        $value = UserVenueRole::query()->where('user_id', $this->user()?->id)->whereIn('role', ['owner', 'manager'])->value('venue_id');

        return $value !== null ? (int) $value : $this->input('venue_id');
    }

    public function rules(): array
    {
        $venueId = $this->venueId();

        return ['venue_id' => ['required', 'exists:venues,id'], 'code' => ['required', 'alpha_dash', 'max:30', Rule::unique('tenants', 'code')->where(fn ($q) => $q->where('venue_id', $venueId))], 'slug' => ['required', 'alpha_dash', 'max:100', Rule::unique('tenants', 'slug')->where(fn ($q) => $q->where('venue_id', $venueId))], 'display_name' => ['required', 'string', 'max:120'], 'commission_rate' => ['required', 'numeric', 'between:0,100'], 'pic_name' => ['required', 'string', 'max:120'], 'pic_email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')], 'bank_code' => ['required', 'string', 'max:20'], 'account_holder' => ['required', 'string', 'max:120'], 'account_number' => ['required', 'digits_between:6,20']];
    }
}
