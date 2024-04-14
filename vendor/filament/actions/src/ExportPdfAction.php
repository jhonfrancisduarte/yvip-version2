<?php

namespace Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\Concerns\CanCustomizeProcess;
use Filament\Support\Facades\FilamentIcon;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Model;

class ExportPdfAction extends Action
{
    use CanCustomizeProcess;

    public static function getDefaultName(): ?string
    {
        return 'export';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Export as PDF'));
        // $this->groupedIcon(FilamentIcon::resolve('actions::export-pdf.grouped') ?? 'heroicon-o-document-download');

        $this->action(function (): void {
            $this->process(function (Model $record) {
                $userAttr = $record->getAttributes();
                $userId = $userAttr['user_id'];
                $userDetails = User::where('users.id', $userId)
                                    ->join('user_data', 'users.id', '=', 'user_data.user_id')
                                    ->select('users.*', 'user_data.*')
                                    ->first();
                $userDetails = $userDetails->getAttributes();
                $pdf = Pdf::loadView('pdf.volunteers-pdf', ['userDetails' => $userDetails]);
                $pdf->setPaper('A4', 'portrait');
                return response()->streamDownload(function () use ($pdf) {
                    echo $pdf->stream();
                }, $userDetails['first_name'] . $userDetails['last_name'] . '_YV.pdf');
            });

            $this->success();
        });
    }
}