<?php


class WebContainerCest
{
    public function _before(UnitTester $I)
    {
    }

    public function _after(UnitTester $I)
    {
    }

  public function checkContainerIsRunning(UnitTester $I){
        $I->wantTo("verify ubuntu container up and running");
        $I->runShellCommand("docker inspect -f {{.State.Running}} bishop_web");
        $I->seeInShellOutput("true");
    }


    public function checkPHPVersion(UnitTester $I){
        $I->wantTo("verify php 7.4 is installed in the container");
        $I->runShellCommand("docker exec bishop_web php --version");
        $I->seeInShellOutput('PHP 7.4');
    }

    public function checkForNologinFile(UnitTester $I){
        $I->wantTo("verify nologin file is not there");
        $I->runShellCommand("docker exec bishop_web ls /var/run/");
        $I->dontSeeInShellOutput("nologin");
    }

//    public function checkApacheServiceIsRunning(UnitTester $I){
//        $I->wantTo("verify apache is up and running in the container");
//        $I->runShellCommand("ping -c 10 localhost");
//        $I->runShellCommand("docker exec infinity_web service httpd status");
//        $I->seeInShellOutput('active (running)');
//    }

    public function checkCronServiceIsRunning(UnitTester $I){
        $I->wantTo("verify cron is up and running in the container");
        $I->runShellCommand("docker exec bishop_web service cron status");
        $I->seeInShellOutput('cron is running');
    }

    public function checkMemcacheServiceIsRunning(UnitTester $I){
        $I->wantTo("verify apache is up and running in the container");
        $I->runShellCommand("docker exec bishop_web service apache2 status");
        $I->seeInShellOutput('apache2 is running');
    }

    public function checkSSHInstallation(UnitTester $I){
            $I->wantTo("verify OpenSSH is installed in the container");
            $I->runShellCommand("docker exec bishop_web dpkg -l | grep openssh-server");
            $I->seeInShellOutput("openssh-server");
    }

    public function checkSSHServiceRunning(UnitTester $I){
            $I->wantTo("verify ssh is up and running in the container");
            $I->runShellCommand("docker exec bishop_web service ssh status");
            $I->seeInShellOutput('sshd is running');
    }

    // public function checkNSSPAMLDAPInstallation(UnitTester $I){
    //         $I->wantTo("verify nss-pam-ldapd is installed in the container");
    //         $I->runShellCommand("docker exec bishop_web dpkg -l | grep nss-pam-ldapd");
    //         $I->seeInShellOutput("nss-pam-ldapd-0.8");
    // }

    public function checkOpenldapInstallation(UnitTester $I){
            $I->wantTo("verify open-ldap is installed in the container");
            $I->runShellCommand("docker exec bishop_web dpkg -l | grep ldap");
            $I->seeInShellOutput("ldap-utils");
    }

    public function checkNSCDInstallation(UnitTester $I){
            $I->wantTo("verify SSSD is installed in the container");
            $I->runShellCommand("docker exec bishop_web dpkg -l | grep sssd");
            $I->seeInShellOutput("sssd");
    }

    public function checkJavaVersion(UnitTester $I){
            $I->wantTo("verify java is installed in the container");
            $I->runShellCommand("docker exec bishop_web java --version");
            $I->seeInShellOutput("openjdk");
    }

    public function checkWgetVersion(UnitTester $I){
            $I->wantTo("verify wget is installed in the container");
            $I->runShellCommand("docker exec bishop_web dpkg -l | grep wget");
            $I->seeInShellOutput("wget");
    }
//    public function checkVHostConfig(UnitTester $I){
//        $I->wantTo("verify test vhost is configured in the container");
//        $I->runShellCommand("docker exec infinity_web httpd -S");
//        $I->seeInShellOutput("*-test-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-uat-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-prod-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-os-infinity.orangehrm.com");
//        $I->seeInShellOutput("*-freehost-infinity.orangehrm.com");
//    }


    public function checkSendMailNoArch(UnitTester $I){
        $I->wantTo("verify wether sendmail noarch is installed");
        $I->runShellCommand("docker exec bishop_web dpkg -l | grep sendmail");
        $I->seeInShellOutput("sendmail");
    }

}
