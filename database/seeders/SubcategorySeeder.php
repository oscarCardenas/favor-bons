<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;
use Carbon\Carbon;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $array = [
            ['category_id' => 1, 'name' => 'Marketing Career Advice ', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Sales Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Finance Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Management', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Engineering Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Entrepreneurial Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'Joining a Startup', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'College Graduate Career Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 1, 'name' => 'General Career Advice ', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 2, 'name' => 'Marketing Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'CEO Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'CFO Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'CIO Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'Engineering Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'HR Situation Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'How to Raise Funding for a Startup', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'How to Find Product-Market Fit for My Business', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'Presentation Assessment', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'Business Plan Assessment', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'General Business', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 2, 'name' => 'Advice', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 3, 'name' => 'Before You Invest in a Startup (list individual company types then that you could provide due diligence on)', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 3, 'name' => 'Before You Sign a Software Contract', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 3, 'name' => 'Before You Sign an Office', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 3, 'name' => 'Lease', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 3, 'name' => 'M&A Due Diligence', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 3, 'name' => 'Private Equity Due Diligence', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 3, 'name' => 'General Due Diligence', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 4, 'name' => 'Angel Investing, ', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 4, 'name' => 'Cryptocurrency, ', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 4, 'name' => 'NFTs (how to create, how it could impact your professional or company), ', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 4, 'name' => 'How to Negotiate (below that is specifics), ', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 4, 'name' => 'Online Advertising (How to do Ads on Major Platforms (Facebook, LinkedIn, etc.), ', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 4, 'name' => 'General Private Lessons', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 5, 'name' => 'Private Business_Company Tours (In-Person)', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 5, 'name' => 'Private Business_Company Tours (Virtual)', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 5, 'name' => 'Private Product_Service Demonstrations (In-Person)', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 5, 'name' => 'Private Product_Service Demonstrations (Virtual)', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 5, 'name' => 'Guided Brainstorming Sessions for Your Team', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 5, 'name' => 'General Private Tours & Demonstrations', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 6, 'name' => 'Extra Computers', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => 'Available Office Furniture', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => 'Office Technology Equipment', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => 'Company Heirlooms_Collectibles', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => 'Autographed_Personal Message on Company Product', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => 'Extra Company Inventory', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => '50% Off My Company’s Product', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 6, 'name' => 'General Physical Goods', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 7, 'name' => 'Extra Software Seats/Licenses', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 7, 'name' => '50% Off My Company’s Software', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 7, 'name' => 'Telecommunications Software', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 7, 'name' => 'CRM Software', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 7, 'name' => 'General Software', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 8, 'name' => 'Guest Passes', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 8, 'name' => 'Unused Gift Certificates', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 8, 'name' => 'Unused Points_Miles', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 8, 'name' => 'Extra Tickets to a Conference_Event/Exhibit', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 8, 'name' => '50% Off My Company’s Services', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 9, 'name' => 'Unused Office Space', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 9, 'name' => 'Unused Vacation Homes', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 9, 'name' => 'Company Offsite Locations', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 9, 'name' => 'Management Team Offsite Locations', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 9, 'name' => 'General Real Estate', 'description' => null, 'type' => null, 'created_at' => $now],
            /** */
            ['category_id' => 10, 'name' => 'Use My CFO for 1/2 Day', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 10, 'name' => 'Use My Land for 1-Year as Company HQ for Remote Workers', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 10, 'name' => 'Shadow a Leading Entrepreneur at Work for 1 Week', 'description' => null, 'type' => null, 'created_at' => $now],
            ['category_id' => 10, 'name' => 'Panerai Men’s Luxury Watch (Slightly Worn by Leading CEO)', 'description' => null, 'type' => null, 'created_at' => $now]
        ];

        Subcategory::insert($array);
    }
}























































































