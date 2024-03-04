<?php

namespace GabrielBarros;

class Mklicense
{
    private string $licensesFolder;
    private array $licenceFiles;

    public function __construct()
    {
        $this->licensesFolder = __DIR__ . '/../licenses';

        $exclude = [
            '.', '..', 'SHA256SUMS'
        ];

        $this->licenceFiles = array_values(array_diff(
            scandir($this->licensesFolder), $exclude
        ));
    }

    public function showError(): void
    {
        $msg = "Usage: mklicense <license name or number>\n\n";
        $msg .= "These are the available licenses:\n\n";

        foreach ($this->licenceFiles as $i => $file) {
            $msg .= str_pad($i, 2, ' ', \STR_PAD_LEFT) . ") $file\n";
        }

        fprintf(\STDERR, $msg);
        exit(1);
    }

    public function exec($argv): void
    {
        // No argument
        if (!isset($argv[1])) {
            $this->showError();
        }

        // Numeric argument or string argument
        if (is_numeric($argv[1])) {
            $key = (int) $argv[1];
            $chosenLicenseFile = $this->licenceFiles[$key] ?? '';
        } else {
            $chosenLicenseFile = strtolower($argv[1]);
        }

        $chosenLicensePath = $this->licensesFolder . '/' . $chosenLicenseFile;

        // No license found
        if (!is_file($chosenLicensePath)) {
            $this->showError();
        }

        if (is_file('LICENSE')) {
            $overwrite = readline('LICENSE already exists. Overwrite it? [Y/n] ');

            if ($overwrite === 'n') {
                exit;
            }
        }

        $licenseContent = file_get_contents($chosenLicensePath);

        // License including year and name
        if (str_contains($licenseContent, '[YEAR]') &&
            str_contains($licenseContent, '[NAME]')) {

            $gitName = exec('git config user.name 2> /dev/null');
            $inputName = readline("Your name? [$gitName] ");

            if ($inputName === '') {
                $inputName = $gitName;
            }

            $search = ['[YEAR]', '[NAME]'];
            $replace = [date('Y'), $inputName];

            $licenseContent = str_replace($search, $replace, $licenseContent);
            file_put_contents('LICENSE', $licenseContent);
        } else {
            copy($chosenLicensePath, 'LICENSE');
        }
        echo "OK\n";
    }
}
