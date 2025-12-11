<?php

namespace Modules\Admin\Services;

use Modules\User\Models\Support;

class SupportService
{
    public function handle() {}

    public function done($id)
    {
        $support = Support::find($id);
        $support->status = 1;
        $support->save();
        return true;
    }

    public function destroy($id)
    {
        $support = Support::find($id);
        $support->delete();
        return true;
    }
}
