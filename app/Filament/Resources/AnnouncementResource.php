<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnnouncementResource\Pages;
use App\Filament\Resources\AnnouncementResource\RelationManagers;
use App\Models\Announcement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
class AnnouncementResource extends Resource
{
    protected static ?string $model = Announcement::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Youth Volunteers';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        $userId = Auth::id();
        return $form
            ->schema([
                Forms\Components\Section::make('Permanent Address')->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->maxLength(50),
                    Forms\Components\TextInput::make('content')
                        ->label('Announcement')
                        ->required()
                        ->maxLength(1000),
                    Forms\Components\Select::make('category')
                        ->options([
                            'training' => 'Training',
                            'event' => 'Event'
                        ])
                        ->required(),
                    Forms\Components\Select::make('type')
                        ->options([
                            'yv' => 'YV Announcement',
                            'ip' => 'IP Announcement'
                        ])
                        ->required(),
                    Forms\Components\FileUpload::make('featured_image')
                        ->preserveFilenames()
                        ->image(),
                    Forms\Components\FileUpload::make('attached_file')
                        ->preserveFilenames()
                        ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'])
                        ->maxSize(2048),
                    Forms\Components\Hidden::make('user_id')
                        ->default($userId)
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table{
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('editor')
                    ->label('Editor')
                    ->searchable()
                    ->formatStateUsing(function ($record) {
                        $user = $record->user;
                        $editor = Admin::where('user_id', $user->id)
                            ->select('first_name', 'last_name')
                            ->first();
                        return $editor->first_name . ' ' . $editor->last_name;}),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('featured_image'),
                Tables\Columns\TextColumn::make('attached_file')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnnouncements::route('/'),
            'create' => Pages\CreateAnnouncement::route('/create'),
            'edit' => Pages\EditAnnouncement::route('/{record}/edit'),
        ];
    }
}
