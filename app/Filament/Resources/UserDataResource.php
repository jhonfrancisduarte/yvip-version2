<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserDataResource\Pages;
use App\Filament\Resources\UserDataResource\RelationManagers;
use App\Models\UserData;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions;
class UserDataResource extends Resource
{
    protected static ?string $model = UserData::class;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Volunteers';
    protected static ?string $modelLabel = 'Volunteers';
    protected static ?string $navigationGroup = 'Youth Volunteers';
    protected static ?string $slug = 'volunteers';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('profile_picture')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\TextInput::make('passport_number')
                        ->maxLength(255)
                        ->default(null),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('first_name')
                            ->required()
                            ->minLength(2)
                            ->maxLength(50),
                        Forms\Components\TextInput::make('middle_name')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                        Forms\Components\TextInput::make('last_name')
                            ->required()
                            ->minLength(2)
                            ->maxLength(50),
                    ])->columns(3),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('nickname')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->required(),
                        Forms\Components\TextInput::make('civil_status')
                            ->required()
                            ->minLength(2)
                            ->maxLength(50),
                    ])->columns(3),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('age')
                            ->required()
                            ->minLength(1)
                            ->numeric(),
                        Forms\Components\TextInput::make('nationality')
                            ->required()
                            ->minLength(2)
                            ->maxLength(50),
                        Forms\Components\TextInput::make('sex')
                            ->required()
                            ->minLength(4)
                            ->maxLength(50),
                    ])->columns(3),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('tel_number')
                            ->tel()
                            ->maxLength(255)
                            ->minLength(7)
                            ->default(null),
                        Forms\Components\TextInput::make('mobile_number')
                            ->required()
                            ->minLength(11)
                            ->maxLength(255),
                        Forms\Components\Select::make('user_id')
                            ->label('User Email')
                            ->options(
                                User::pluck('email', 'id')->toArray()
                            )
                            ->required(),
                    ])->columns(3),
                ]),
                    Forms\Components\Section::make('Permanent Address')->schema([
                        Forms\Components\TextInput::make('permanent_selectedProvince')
                            ->label('Province')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('permanent_selectedCity')
                            ->label('City / Municipality')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('p_street_barangay')
                            ->label('House number | Street | Barangay')
                            ->required()
                            ->minLength(2)
                            ->maxLength(200)
                            ->columnSpanFull()
                    ])->columns(2),
                    Forms\Components\Section::make('Residential Address')->schema([
                        Forms\Components\TextInput::make('residential_selectedProvince')
                            ->label('Province')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('residential_selectedCity')
                            ->label('City / Municipality')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('r_street_barangay')
                            ->label('House number | Street | Barangay')
                            ->required()
                            ->minLength(2)
                            ->maxLength(200)
                            ->columnSpanFull()
                    ])->columns(2),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\TextInput::make('educational_background')
                            ->required()
                            ->minLength(2)
                            ->maxLength(50),
                        Forms\Components\TextInput::make('blood_type')
                            ->maxLength(5)
                            ->default(null),
                        Forms\Components\TextInput::make('status')
                            ->required()
                            ->maxLength(50),
                    ])->columns(3),
                    Forms\Components\Section::make('Professional')->schema([
                        Forms\Components\TextInput::make('nature_of_work')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                        Forms\Components\TextInput::make('employer')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                    ])->columns(2),
                    Forms\Components\Section::make('Student')->schema([
                        Forms\Components\TextInput::make('name_of_school')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                        Forms\Components\TextInput::make('course')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null)
                    ])->columns(2),
                    Forms\Components\Section::make('Organization')->schema([
                        Forms\Components\TextInput::make('organization_name')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                        Forms\Components\TextInput::make('org_position')
                            ->label('Position')
                            ->maxLength(50)
                            ->minLength(2)
                            ->default(null),
                    ])->columns(2),
                    Forms\Components\Section::make()->schema([
                        Forms\Components\Toggle::make('is_volunteer'),
                        Forms\Components\Toggle::make('is_ip_participant')
                    ])->columns(2),
                ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('passport_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('middle_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('last_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nickname')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date_of_birth')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('civil_status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nationality')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tel_number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('mobile_number')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('sex')
                    ->searchable(),
                Tables\Columns\TextColumn::make('permanent_selectedProvince')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('permanent_selectedCity')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('p_street_barangay')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('residential_selectedProvince')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('residential_selectedCity')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('r_street_barangay')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('educational_background')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('blood_type')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('nature_of_work')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('employer')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('profile_picture')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_volunteer')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('is_ip_participant')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('name_of_school')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('course')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('organization_name')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('org_position')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Actions\ExportPdfAction::make(),
                ])
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
            'index' => Pages\ListUserData::route('/'),
            'create' => Pages\CreateUserData::route('/create'),
            'view' => Pages\ViewUserData::route('/{record}'),
            'edit' => Pages\EditUserData::route('/{record}/edit'),
        ];
    }
}
