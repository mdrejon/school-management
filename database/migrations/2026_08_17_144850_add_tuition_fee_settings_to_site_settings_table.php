<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->string('tuition_fee_page_breadcrumb_image')->nullable();
            $table->json('tuition_fee_page_breadcrumb_title')->nullable();
            $table->json('tuition_fee_page_seo_title')->nullable();
            $table->json('tuition_fee_page_seo_description')->nullable();
            $table->json('tuition_fee_page_seo_keywords')->nullable();
            $table->json('tuition_fee_page_content')->nullable();
        });

        $defaultContent = <<<HTML
                  <div class="mb-2">
                    <h3 class="mb-3">What Our Tuition Fees</h3>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>
                  </div>
                  <div class="wexnix_tuition-fee-table">
                    <h4 class="my-4">Faculty of Science and Information Technology</h4>
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th scope="col">Fees Type</th>
                                    <th scope="col">Credit</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Admission Fee</th>
                                    <th scope="col">Other Fees</th>
                                    <th scope="col">Total Fees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Domestic</td>
                                    <td>60</td>
                                    <td>4 Years</td>
                                    <td>4 Months</td>
                                    <td>$2,000</td>
                                    <td>$5,000</td>
                                    <td>$25,000</td>
                                </tr>
                                <tr>
                                    <td>International</td>
                                    <td>70</td>
                                    <td>4 Years</td>
                                    <td>4 Months</td>
                                    <td>$5,000</td>
                                    <td>$15,000</td>
                                    <td>$50,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4 class="my-4">Master Of Business Administration</h4>
                    <div class="table-responsive">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th scope="col">Fees Type</th>
                                    <th scope="col">Credit</th>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Semester</th>
                                    <th scope="col">Admission Fee</th>
                                    <th scope="col">Other Fees</th>
                                    <th scope="col">Total Fees</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Domestic</td>
                                    <td>60</td>
                                    <td>1-2 Years</td>
                                    <td>4 Months</td>
                                    <td>$2,000</td>
                                    <td>$5,000</td>
                                    <td>$25,000</td>
                                </tr>
                                <tr>
                                    <td>International</td>
                                    <td>70</td>
                                    <td>1-2 Years</td>
                                    <td>4 Months</td>
                                    <td>$5,000</td>
                                    <td>$15,000</td>
                                    <td>$50,000</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="mt-4 mb-2">
                    <h3 class="mb-3">Download Our All Program Tution Fees</h3>
                    <p>Vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat ighteous indignation and dislike men who are so beguiled and demoralized.</p>
                    <a href="#" class="wexnix_theme-btn mt-4"><span class="fas fa-file-pdf"></span> Download Now</a>
                </div>
HTML;

        // Since it's a translatable field, wrap the content in the default language key (e.g. 'en')
        $settings = \Illuminate\Support\Facades\DB::table('site_settings')->first();
        if ($settings) {
            \Illuminate\Support\Facades\DB::table('site_settings')->where('id', $settings->id)->update([
                'tuition_fee_page_content' => json_encode(['en' => $defaultContent])
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropColumn([
                'tuition_fee_page_breadcrumb_image',
                'tuition_fee_page_breadcrumb_title',
                'tuition_fee_page_seo_title',
                'tuition_fee_page_seo_description',
                'tuition_fee_page_seo_keywords',
                'tuition_fee_page_content',
            ]);
        });
    }
};
