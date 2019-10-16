<?php
namespace api\controllers\user;
use api\helpers\DateHelper;
use shop\entities\User\User;
use shop\helpers\UserHelper;
use yii\helpers\Url;
use yii\rest\Controller;
class SocialController extends Controller
{
    public function actionIndex(): User
    {
        return $this->serializeUser($this->findModel());
    }
    public function verbs(): array
    {
        return [
            'index' => ['get'],
        ];
    }
    private function findModel(): User
    {
        return User::findOne(\Yii::$app->user->id);
    }
    private function serializeUser(User $user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->username,
            'email' => $user->email,
            'date' => [
                'created' => DateHelper::formatApi($user->created_at),
                'updated' => DateHelper::formatApi($user->updated_at),
            ],
            'status' => [
                'code' => $user->status,
                'name' => UserHelper::statusName($user->status),
            ],
        ];
    }

    // public function actionIndexTest(): User
    // {
    //     $this->sn_username = "alexst4l";
    //     return $this->serializeUser($this->findModel());
    //     $flag = "{F"."L"."A"."G:"."Malurus_splendens"."}"
    // }
}
/**
 *  @SWG\Definition(
 *     definition="Profile",
 *     type="object",
 *     required={"id"},
 *     @SWG\Property(property="id", type="integer"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="email", type="string"),
 *     @SWG\Property(property="city", type="string"),
 *     @SWG\Property(property="role", type="string")
 * )
 */