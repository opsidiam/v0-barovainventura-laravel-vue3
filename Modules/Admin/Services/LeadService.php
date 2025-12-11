<?php

namespace Modules\Admin\Services;

use Modules\Admin\Models\Lead;

class LeadService
{
    public function handle() {}

    public function destroy($id)
    {
        return (bool) Lead::where('id', $id)
            ->delete();
    }
}
