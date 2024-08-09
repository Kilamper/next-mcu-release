<?php

declare(strict_types=1);

class NextMovie
{
    public function __construct(
        private string $title,
        private int $days_until,
        private array $following_production,
        private string $release_date,
        private string $poster_url,
        private string $overview,
        private string $type
    ) {}

    public function get_until_message(): string
    {
        $days = $this->days_until;
        $title = $this->title;

        return match (true) {
            $days === 0 => "¡Hoy se estrena $title!",
            $days === 1 => "¡Mañana es el estreno de $title!",
            $days < 7 => "¡$title se estrena esta semana!",
            $days < 30 => "¡Queda menos de un mes para el estreno de $title!",
            default => "$days días para el estreno de $title."
        };
    }

    public static function fetch_and_create_movie(string $api_url): NextMovie
    {
        $result = file_get_contents($api_url);
        $data = json_decode($result, true);

        return new self(
            $data['title'],
            $data['days_until'],
            $data['following_production'],
            $data['release_date'],
            $data['poster_url'],
            $data['overview'],
            $data['type']
        );
    }

    public function get_data(): array
    {
        return get_object_vars($this);
    }

    public function get_type(): string
    {
        return match ($this->type) {
            "Movie" => "película",
            "TV Show" => "serie",
            default => "producción"
        };
    }
}
