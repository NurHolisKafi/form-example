<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApplyRequest;
use App\Http\Resources\JobsCollection;
use App\Models\Candidates;
use App\Models\Jobs;
use App\Models\Skills;

class LamaranController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/store",
     *     summary="Menambahkan kandidat baru",
     *     tags={"Candidates"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"job_id", "name", "email", "phone", "year", "skillset"},
     *             @OA\Property(
     *                 property="job_id",
     *                 type="integer",
     *                 minimum=1,
     *                 description="Job Id"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Nama lengkap",
     *                 example= "John Doe"
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *                 format="email",
     *                 description="Alamat email",
     *                 example= "johndoe@gmail.com"
     *             ),
     *             @OA\Property(
     *                 property="phone",
     *                 type="string",
     *                 description="Nomor telepon",
     *                 example= "086677118827"
     *             ),
     *             @OA\Property(
     *                 property="year",
     *                 type="integer",
     *                 description="Tahun lahir",
     *                 example= "2000"
     *             ),
     *             @OA\Property(
     *                 property="skillset",
     *                 type="array",
     *                 description="Daftar keterampilan yang dimiliki",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="integer",
     *                         description="ID keterampilan",
     *                         example= "1"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         description="Nama keterampilan",
     *                         example= "Programming"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data Berhasil Ditambahkan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="Success"),
     *             @OA\Property(property="message", type="string", example="Data Berhasil Ditambahkan")
     *         )
     *     )
     * )
     */

    public function store(ApplyRequest $request)
    {
        $request->validated();
        $dataCandidate = $request->except('skillset');
        $newCandidate = Candidates::create($dataCandidate);
        foreach ($request->skillset as $key) {
            $newCandidate->skills()->sync($key['id']);
        }

        return response()->json([
            'status' => 'Success',
            'message' => 'Data Berhasil Ditambahkan'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/skills",
     *     summary="Mendapatkan data skills",
     *     tags={"Skills"},
     *     @OA\Response(
     *         response=200,
     *         description="ok",
     *         @OA\JsonContent(
     *            type="array",
     *            @OA\Items(
     *               @OA\Property(property="id", type="integer", example="1"),
     *               @OA\Property(property="name", type="string", example="Programming")
     *            )
     *         )
     *     )
     * )
     */
    public function getSkills()
    {
        return response()->json(Skills::select('id', 'name')->get());
    }

    /**
     * @OA\Get(
     *     path="/api/jobs",
     *     summary="Mendapatkan data jobs",
     *     tags={"Jobs"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example="1" ),
     *                 @OA\Property(property="name", type="string", example="Fence Erector")
     *             )
     *         )
     *     )
     * )
     */
    public function getJobs()
    {
        return response()->json(Jobs::select('id', 'name')->get());
    }
}
