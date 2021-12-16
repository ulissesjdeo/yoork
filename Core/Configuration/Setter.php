<?php

# Definition of namespace
namespace Core\Configuration;

# Definition of classname
class Setter
{
    # Using this method to routes the configurations
    public function configure(): void
    {
        # Setting-up ini configurations
        $ini = new Ini();
        $ini->configure();

        # Setting-up security configurations
        $security = new Security();
        $security->configure();

        # Setting-up region configurations
        $region = new Region();
        $region->configure();

        # Setting-up session configurations
        $session = new Session();
        $session->configure();

        # Setting-up performance configurations
        $performance = new Performance();
        $performance->configure();
    }
}