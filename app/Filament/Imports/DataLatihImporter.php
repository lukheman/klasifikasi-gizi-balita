<?php

namespace App\Filament\Imports;

use App\Models\DataLatih;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class DataLatihImporter extends Importer
{
    protected static ?string $model = DataLatih::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('nama')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('umur')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('berat')
                ->label('Berat (Kg)')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'numeric']),
            ImportColumn::make('tinggi')
                ->label('Tinggi (Cm)')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'numeric']),
            ImportColumn::make('status')
                ->requiredMapping()
                ->rules(['required', 'in:stunting,underweight,normal,wasting,overweight']),
        ];
    }

    public function resolveRecord(): ?DataLatih
    {
        // return DataLatih::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new DataLatih();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your data latih import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
