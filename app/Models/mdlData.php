<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Support\Facades\DB;

class mdlData extends Model
{
    use HasFactory;
    public $table = 'import';
    // protected $fillable = [
    //     'Name',
    //     'Given Name',
    //     'Additional Name',
    //     'Family Name',
    //     'Yomi Name',
    //     'Given Name Yomi',
    //     'Additional Name Yomi',
    //     'Family Name Yomi',
    //     'Name Prefix',
    //     'Name Suffix',
    //     'Initials',
    //     'Nickname',
    //     'Short Name',
    //     'Maiden Name',
    //     'Birthday',
    //     'Gender',
    //     'Location',
    //     'Billing Information',
    //     'Directory Server',
    //     'Mileage',
    //     'Occupation',
    //     'Hobby',
    //     'Sensitivity',
    //     'Priority',
    //     'Subject',
    //     'Notes',
    //     'Group Membership',
    //     'E-mail 1 - Type',
    //     'E-mail 1 - Value',
    //     'E-mail 2 - Type',
    //     'E-mail 2 - Value',
    //     'E-mail 3 - Type',
    //     'E-mail 3 - Value',
    //     'Phone 1 - Type',
    //     'Phone 1 - Value',
    //     'Phone 2 - Type',
    //     'Phone 2 - Value',
    //     'Address 1 - Type',
    //     'Address 1 - Formatted',
    //     'Address 1 - Street',
    //     'Address 1 - City',
    //     'Address 1 - PO Box',
    //     'Address 1 - Region',
    //     'Address 1 - Postal Code',
    //     'Address 1 - Country',
    //     'Address 1 - Extended Address',
    //     'Address 2 - Type',
    //     'Address 2 - Formatted',
    //     'Address 2 - Street',
    //     'Address 2 - City',
    //     'Address 2 - PO Box',
    //     'Address 2 - Region',
    //     'Address 2 - Postal Code',
    //     'Address 2 - Country',
    //     'Address 2 - Extended Address',
    //     'Organization 1 - Type',
    //     'Organization 1 - Name',
    //     'Organization 1 - Yomi Name',
    //     'Organization 1 - Title',
    //     'Organization 1 - Department',
    //     'Organization 1 - Symbol',
    //     'Organization 1 - Location',
    //     'Organization 1 - Job Description',
    //     'Website 1 - Type',
    //     'Website 1 - Value',
    //     'Custom Field 1 - Type',
    //     'Custom Field 1 - Value', 'updated_at', 'created_at',
    // ];
    protected $guarded = [];

    public function __construct()
    {
        // SHOW CREATE TABLE 'basic'.'datausers';
        // \Illuminate\Support\Facades\DB::select("SHOW CREATE TABLE 'basic'.$this->table;");
    }
}
