<?php

class Cleo__browser
	{
		private $_userAgent = ""; // STRING - _userAgent_STRING
		private $_os = ""; // STRING - operating system
		private $_osVersion = ""; // STRING - operating system version
		private $_browser = "" ;// STRING - _browser name
		private $_browserVersion = ""; // STRING - _browser version
		private $_netClr = false; // BOOL - .NET Common Language Runtime
		private $_resolved = false; // BOOL - resolving proceeded
		private $_type = ""; // STRING - _browser/Robot
		
		
		public function __construct( $userAgent ) 
		{
			$this->_userAgent = $userAgent;
			$this->_resolve();
			$this->_resolved = true;
		}
	
		private function _resolve()
		{
			$this->_resolved = false;
			$this->_os = "";
			$this->_osVersion = "";
			$this->_netClr = false;
			
			$this->_getOperatingSystem();
			$this->_get_browser();
			$this->_getNetClr();
		}
		
		/***********************************************************************************/
		
		private function _getNetClr()
		{
			if (eregi("NET CLR",$this->_userAgent)) {$this->_netClr = true;}
		}
		
		
		private function _getOperatingSystem()
		{
			if (eregi("win",$this->_userAgent))
			{
				$this->_os = "Windows";
				if ((eregi("Windows 95",$this->_userAgent)) || (eregi("Win95",$this->_userAgent))) {$this->_osVersion = "95";}
				elseif (eregi("Windows ME",$this->_userAgent) || (eregi("Win 9x 4.90",$this->_userAgent))) {$this->_osVersion = "ME";}
				elseif ((eregi("Windows 98",$this->_userAgent)) || (eregi("Win98",$this->_userAgent))) {$this->_osVersion = "98";}
				elseif ((eregi("Windows NT 5.0",$this->_userAgent)) || (eregi("WinNT5.0",$this->_userAgent)) || (eregi("Windows 2000",$this->_userAgent)) || (eregi("Win2000",$this->_userAgent))) {$this->_osVersion = "2000";}
				elseif ((eregi("Windows NT 5.1",$this->_userAgent)) || (eregi("WinNT5.1",$this->_userAgent)) || (eregi("Windows XP",$this->_userAgent))) {$this->_osVersion = "XP";}
				elseif ((eregi("Windows NT 5.2",$this->_userAgent)) || (eregi("WinNT5.2",$this->_userAgent))) {$this->_osVersion = ".NET 2003";}
				elseif ((eregi("Windows NT 6.0",$this->_userAgent)) || (eregi("WinNT6.0",$this->_userAgent))) {$this->_osVersion = "Vista";}
				elseif (eregi("Windows CE",$this->_userAgent)) {$this->_osVersion = "CE";}
				elseif (eregi("Win3.11",$this->_userAgent)) {$this->_osVersion = "3.11";}
				elseif (eregi("Win3.1",$this->_userAgent)) {$this->_osVersion = "3.1";}
				elseif ((eregi("Windows NT",$this->_userAgent)) || (eregi("WinNT",$this->_userAgent))) {$this->_osVersion = "NT";}
			}
			elseif (eregi("lindows",$this->_userAgent))
			{
				$this->_os = "Lindows_os";
			}
			elseif (eregi("mac",$this->_userAgent))
			{
				$this->_os = "MacInt_osh";
				if ((eregi("Mac _os X",$this->_userAgent)) || (eregi("Mac 10",$this->_userAgent))) {$this->_osVersion = "_os X";}
				elseif ((eregi("PowerPC",$this->_userAgent)) || (eregi("PPC",$this->_userAgent))) {$this->_osVersion = "PPC";}
				elseif ((eregi("68000",$this->_userAgent)) || (eregi("68k",$this->_userAgent))) {$this->_osVersion = "68K";}
			}
			elseif (eregi("linux",$this->_userAgent))
			{
				$this->_os = "Linux";
				if (eregi("i686",$this->_userAgent)) {$this->_osVersion = "i686";}
				elseif (eregi("i586",$this->_userAgent)) {$this->_osVersion = "i586";}
				elseif (eregi("i486",$this->_userAgent)) {$this->_osVersion = "i486";}
				elseif (eregi("i386",$this->_userAgent)) {$this->_osVersion = "i386";}
				elseif (eregi("ppc",$this->_userAgent)) {$this->_osVersion = "ppc";}
			}
			elseif (eregi("sun_os",$this->_userAgent))
			{
				$this->_os = "Sun_os";
			}
			elseif (eregi("hp-ux",$this->_userAgent))
			{
				$this->_os = "HP-UX";
			}
			elseif (eregi("_osf1",$this->_userAgent))
			{
				$this->_os = "_osF1";
			}
			elseif (eregi("freebsd",$this->_userAgent))
			{
				$this->_os = "FreeBSD";
				if (eregi("i686",$this->_userAgent)) {$this->_osVersion = "i686";}
				elseif (eregi("i586",$this->_userAgent)) {$this->_osVersion = "i586";}
				elseif (eregi("i486",$this->_userAgent)) {$this->_osVersion = "i486";}
				elseif (eregi("i386",$this->_userAgent)) {$this->_osVersion = "i386";}
			}
			elseif (eregi("netbsd",$this->_userAgent))
			{
				$this->_os = "NetBSD";
				if (eregi("i686",$this->_userAgent)) {$this->_osVersion = "i686";}
				elseif (eregi("i586",$this->_userAgent)) {$this->_osVersion = "i586";}
				elseif (eregi("i486",$this->_userAgent)) {$this->_osVersion = "i486";}
				elseif (eregi("i386",$this->_userAgent)) {$this->_osVersion = "i386";}
			}
			elseif (eregi("irix",$this->_userAgent))
			{
				$this->_os = "IRIX";
			}
			elseif (eregi("_os/2",$this->_userAgent))
			{
				$this->_os = "_os/2";
				if (eregi("Warp 4.5",$this->_userAgent)) {$this->_osVersion = "Warp 4.5";}
				elseif (eregi("Warp 4",$this->_userAgent)) {$this->_osVersion = "Warp 4";}
			}
			elseif (eregi("amiga",$this->_userAgent))
			{
				$this->_os = "Amiga";
			}
			elseif (eregi("liberate",$this->_userAgent))
			{
				$this->_os = "Liberate";
			}
			elseif (eregi("qnx",$this->_userAgent))
			{
				$this->_os = "QNX";
				if (eregi("photon",$this->_userAgent)) {$this->_osVersion = "Photon";}
			}
			elseif (eregi("dreamcast",$this->_userAgent))
			{
				$this->_os = "Sega Dreamcast";
			}
			elseif (eregi("palm",$this->_userAgent))
			{
				$this->_os = "Palm";
			}
			elseif (eregi("powertv",$this->_userAgent))
			{
				$this->_os = "PowerTV";
			}
			elseif (eregi("prodigy",$this->_userAgent))
			{
				$this->_os = "Prodigy";
			}
			elseif (eregi("symbian",$this->_userAgent))
			{
				$this->_os = "Symbian";
				if (eregi("symbian_os/6.1",$this->_userAgent)) {$this->_browserVersion = "6.1";}
			}
			elseif (eregi("unix",$this->_userAgent))
			{
				$this->_os = "Unix";
			}
			elseif (eregi("webtv",$this->_userAgent))
			{
				$this->_os = "WebTV";
			}
			elseif (eregi("sie-cx35",$this->_userAgent))
			{
				$this->_os = "Siemens CX35";
			}
		}
		
		
		private function _get_browser()
		{
			// boti
			if (eregi("msnbot",$this->_userAgent))
			{
				$this->_browser = "MSN Bot";
				$this->_type = "Robot";
				if (eregi("msnbot/0.11",$this->_userAgent)) {$this->_browserVersion = "0.11";}
				elseif (eregi("msnbot/0.30",$this->_userAgent)) {$this->_browserVersion = "0.3";}
				elseif (eregi("msnbot/1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
				elseif (eregi("msnbot-media/1.0",$this->_userAgent)) {$this->_browserVersion = "Media 1.0";}
			}
			elseif (eregi("almaden",$this->_userAgent))
			{
				$this->_browser = "IBM Almaden Crawler";
				$this->_type = "Robot";
			}
			elseif (eregi("BecomeBot",$this->_userAgent))
			{
				$this->_browser = "BecomeBot";
				if (eregi("becomebot/1.23",$this->_userAgent)) {$this->_browserVersion = "1.23";}
				$this->_type = "Robot";
			}
			elseif (eregi("Link-Checker-Pro",$this->_userAgent))
			{
				$this->_browser = "Link Checker Pro";
				$this->_type = "Robot";
			}
			elseif (eregi("ia_archiver",$this->_userAgent))
			{
				$this->_browser = "Alexa";
				$this->_type = "Robot";
			}
			elseif ((eregi("googlebot",$this->_userAgent)) || (eregi("google",$this->_userAgent)))
			{
				$this->_browser = "Google Bot";
				$this->_type = "Robot";
				if ((eregi("googlebot/2.1",$this->_userAgent)) || (eregi("google/2.1",$this->_userAgent))) {$this->_browserVersion = "2.1";}
				elseif ((eregi("Google Desktop",$this->_userAgent)) ) {$this->_browserVersion = "Desktop";}
				elseif ((eregi("Googlebot-Image/1.0",$this->_userAgent)) ) {$this->_browserVersion = "Image 1.0";}
			}
			elseif (eregi("surveybot",$this->_userAgent))
			{
				$this->_browser = "Survey Bot";
				$this->_type = "Robot";
				if (eregi("surveybot/2.3",$this->_userAgent)) {$this->_browserVersion = "2.3";}
			}
			elseif (eregi("zyborg",$this->_userAgent))
			{
				$this->_browser = "ZyBorg";
				$this->_type = "Robot";
				if (eregi("zyborg/1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
			}
			elseif (eregi("w3c-checklink",$this->_userAgent))
			{
				$this->_browser = "W3C Checklink";
				$this->_type = "Robot";
				if (eregi("checklink/3.6",$this->_userAgent)) {$this->_browserVersion = "3.6";}
			}
			elseif (eregi("linkwalker",$this->_userAgent))
			{
				$this->_browser = "LinkWalker";
				$this->_type = "Robot";
			}
			elseif (eregi("fast-webcrawler",$this->_userAgent))
			{
				$this->_browser = "Fast WebCrawler";
				$this->_type = "Robot";
				if (eregi("webcrawler/3.8",$this->_userAgent)) {$this->_browserVersion = "3.8";}
			}
			elseif ((eregi("yahoo",$this->_userAgent)) && (eregi("slurp",$this->_userAgent)))
			{
				$this->_browser = "Yahoo! Slurp";
				$this->_type = "Robot";
			}
			elseif (eregi("naverbot",$this->_userAgent))
			{
				$this->_browser = "NaverBot";
				$this->_type = "Robot";
				if (eregi("dloader/1.5",$this->_userAgent)) {$this->_browserVersion = "1.5";}
			}
			elseif (eregi("converacrawler",$this->_userAgent))
			{
				$this->_browser = "ConveraCrawler";
				$this->_type = "Robot";
				if (eregi("converacrawler/0.5",$this->_userAgent)) {$this->_browserVersion = "0.5";}
			}
			elseif (eregi("w3c_validator",$this->_userAgent))
			{
				$this->_browser = "W3C Validator";
				$this->_type = "Robot";
				if (eregi("w3c_validator/1.305",$this->_userAgent)) {$this->_browserVersion = "1.305";}
			}
			elseif (eregi("innerprisebot",$this->_userAgent))
			{
				$this->_browser = "Innerprise";
				$this->_type = "Robot";
				if (eregi("innerprise/1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
			}
			elseif (eregi("topicspy",$this->_userAgent))
			{
				$this->_browser = "Topicspy Checkbot";
				$this->_type = "Robot";
			}
			elseif (eregi("poodle predictor",$this->_userAgent))
			{
				$this->_browser = "Poodle Predictor";
				$this->_type = "Robot";
				if (eregi("poodle predictor 1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
			}
			elseif (eregi("ichiro",$this->_userAgent))
			{
				$this->_browser = "Ichiro";
				$this->_type = "Robot";
				if (eregi("ichiro/1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
			}
			elseif (eregi("link checker pro",$this->_userAgent))
			{
				$this->_browser = "Link Checker Pro";
				$this->_type = "Robot";
				if (eregi("link checker pro 3.2.16",$this->_userAgent)) {$this->_browserVersion = "3.2.16";}
			}
			elseif (eregi("grub-client",$this->_userAgent))
			{
				$this->_browser = "Grub client";
				$this->_type = "Robot";
				if (eregi("grub-client-2.3",$this->_userAgent)) {$this->_browserVersion = "2.3";}
			}
			elseif (eregi("gigabot",$this->_userAgent))
			{
				$this->_browser = "Gigabot";
				$this->_type = "Robot";
				if (eregi("gigabot/2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
			elseif (eregi("psbot",$this->_userAgent))
			{
				$this->_browser = "PSBot";
				$this->_type = "Robot";
				if (eregi("psbot/0.1",$this->_userAgent)) {$this->_browserVersion = "0.1";}
			}
			elseif (eregi("mj12bot",$this->_userAgent))
			{
				$this->_browser = "MJ12Bot";
				$this->_type = "Robot";
				if (eregi("mj12bot/v0.5",$this->_userAgent)) {$this->_browserVersion = "0.5";}
			}
			elseif (eregi("nextgensearchbot",$this->_userAgent))
			{
				$this->_browser = "NextGenSearchBot";
				$this->_type = "Robot";
				if (eregi("nextgensearchbot 1",$this->_userAgent)) {$this->_browserVersion = "1";}
			}
			elseif (eregi("tutorgigbot",$this->_userAgent))
			{
				$this->_browser = "TutorGigBot";
				$this->_type = "Robot";
				if (eregi("bot/1.5",$this->_userAgent)) {$this->_browserVersion = "1.5";}
			}
			elseif (ereg("NG",$this->_userAgent))
			{
				$this->_browser = "Exabot NG";
				$this->_type = "Robot";
				if (eregi("ng/2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
			elseif (eregi("gaisbot",$this->_userAgent))
			{
				$this->_browser = "Gaisbot";
				$this->_type = "Robot";
				if (eregi("gaisbot/3.0",$this->_userAgent)) {$this->_browserVersion = "3.0";}
			}
			elseif (eregi("xenu link sleuth",$this->_userAgent))
			{
				$this->_browser = "Xenu Link Sleuth";
				$this->_type = "Robot";
				if (eregi("xenu link sleuth 1.2",$this->_userAgent)) {$this->_browserVersion = "1.2";}
			}
			elseif (eregi("turnitinbot",$this->_userAgent))
			{
				$this->_browser = "TurnitinBot";
				$this->_type = "Robot";
				if (eregi("turnitinbot/2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
			elseif (eregi("iconsurf",$this->_userAgent))
			{
				$this->_browser = "IconSurf";
				$this->_type = "Robot";
				if (eregi("iconsurf/2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
			elseif (eregi("zoe indexer",$this->_userAgent))
			{
				$this->_browser = "Zoe Indexer";
				$this->_type = "Robot";
				if (eregi("v1.x",$this->_userAgent)) {$this->_browserVersion = "1";}
			}
			elseif (eregi("WebAlta Crawler",$this->_userAgent))
			{
				$this->_browser = "WebAlta Crawler ";
				$this->_type = "Robot";
				if (eregi("2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
			elseif (eregi("CSE HTML Validator",$this->_userAgent))
			{
				$this->_browser = "CSE HTML Validator ";
				$this->_type = "Analyzer";
				$this->_browserVersion = "";
			}
			elseif (eregi("curl",$this->_userAgent))
			{
				$this->_browser = "Curl library ";
				$this->_type = "Script";
				$this->_browserVersion = "";
			}
			elseif (eregi("crawl/Nutch",$this->_userAgent))
			{
				$this->_browser = "Nutch ";
				$this->_type = "Robot";
				if (eregi("0.9",$this->_userAgent)) {$this->_browserVersion = "0.9";}
			}
			elseif (eregi("panscient.com",$this->_userAgent))
			{
				$this->_browser = "panscient.com";
				$this->_type = "Robot";
				$this->_browserVersion = "";
			}
			// prehliadace
			elseif (eregi("amaya",$this->_userAgent))
			{
				$this->_browser = "amaya";
				$this->_type = "Navigateur";
				if (eregi("amaya/5.0",$this->_userAgent)) {$this->_browserVersion = "5.0";}
				elseif (eregi("amaya/5.1",$this->_userAgent)) {$this->_browserVersion = "5.1";}
				elseif (eregi("amaya/5.2",$this->_userAgent)) {$this->_browserVersion = "5.2";}
				elseif (eregi("amaya/5.3",$this->_userAgent)) {$this->_browserVersion = "5.3";}
				elseif (eregi("amaya/6.0",$this->_userAgent)) {$this->_browserVersion = "6.0";}
				elseif (eregi("amaya/6.1",$this->_userAgent)) {$this->_browserVersion = "6.1";}
				elseif (eregi("amaya/6.2",$this->_userAgent)) {$this->_browserVersion = "6.2";}
				elseif (eregi("amaya/6.3",$this->_userAgent)) {$this->_browserVersion = "6.3";}
				elseif (eregi("amaya/6.4",$this->_userAgent)) {$this->_browserVersion = "6.4";}
				elseif (eregi("amaya/7.0",$this->_userAgent)) {$this->_browserVersion = "7.0";}
				elseif (eregi("amaya/7.1",$this->_userAgent)) {$this->_browserVersion = "7.1";}
				elseif (eregi("amaya/7.2",$this->_userAgent)) {$this->_browserVersion = "7.2";}
				elseif (eregi("amaya/8.0",$this->_userAgent)) {$this->_browserVersion = "8.0";}
			}
			elseif ((eregi("ApacheBench",$this->_userAgent)))
			{
				$this->_browser = "Apache Bench";
				$this->_type = "Benchmark Tool";
				$this->_browserVersion = "";
			}
			elseif ((eregi("aol",$this->_userAgent)) && !(eregi("msie",$this->_userAgent)))
			{
				$this->_browser = "AOL";
				$this->_type = "Navigateur";
				if ((eregi("aol 7.0",$this->_userAgent)) || (eregi("aol/7.0",$this->_userAgent))) {$this->_browserVersion = "7.0";}
			}
			elseif ((eregi("aweb",$this->_userAgent)) || (eregi("amigavoyager",$this->_userAgent)))
			{
				$this->_browser = "AWeb";
				$this->_type = "Navigateur";
				if (eregi("voyager/1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
				elseif (eregi("voyager/2.95",$this->_userAgent)) {$this->_browserVersion = "2.95";}
				elseif ((eregi("voyager/3",$this->_userAgent)) || (eregi("aweb/3.0",$this->_userAgent))) {$this->_browserVersion = "3.0";}
				elseif (eregi("aweb/3.1",$this->_userAgent)) {$this->_browserVersion = "3.1";}
				elseif (eregi("aweb/3.2",$this->_userAgent)) {$this->_browserVersion = "3.2";}
				elseif (eregi("aweb/3.3",$this->_userAgent)) {$this->_browserVersion = "3.3";}
				elseif (eregi("aweb/3.4",$this->_userAgent)) {$this->_browserVersion = "3.4";}
				elseif (eregi("aweb/3.9",$this->_userAgent)) {$this->_browserVersion = "3.9";}
			}
			elseif (eregi("beonex",$this->_userAgent))
			{
				$this->_browser = "Beonex";
				$this->_type = "Navigateur";
				if (eregi("beonex/0.8.2",$this->_userAgent)) {$this->_browserVersion = "0.8.2";}
				elseif (eregi("beonex/0.8.1",$this->_userAgent)) {$this->_browserVersion = "0.8.1";}
				elseif (eregi("beonex/0.8",$this->_userAgent)) {$this->_browserVersion = "0.8";}
			}
			elseif (eregi("camino",$this->_userAgent))
			{
				$this->_browser = "Camino";
				$this->_type = "Navigateur";
				if (eregi("camino/0.7",$this->_userAgent)) {$this->_browserVersion = "0.7";}
			}
			elseif (eregi("cyberdog",$this->_userAgent))
			{
				$this->_browser = "Cyberdog";
				$this->_type = "Navigateur";
				if (eregi("cybergog/1.2",$this->_userAgent)) {$this->_browserVersion = "1.2";}
				elseif (eregi("cyberdog/2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
				elseif (eregi("cyberdog/2.0b1",$this->_userAgent)) {$this->_browserVersion = "2.0b1";}
			}
			elseif (eregi("dillo",$this->_userAgent))
			{
				$this->_browser = "Dillo";
				$this->_type = "Navigateur";
				if (eregi("dillo/0.6.6",$this->_userAgent)) {$this->_browserVersion = "0.6.6";}
				elseif (eregi("dillo/0.7.2",$this->_userAgent)) {$this->_browserVersion = "0.7.2";}
				elseif (eregi("dillo/0.7.3",$this->_userAgent)) {$this->_browserVersion = "0.7.3";}
				elseif (eregi("dillo/0.8",$this->_userAgent)) {$this->_browserVersion = "0.8";}
			}
			elseif (eregi("doris",$this->_userAgent))
			{
				$this->_browser = "Doris";
				$this->_type = "Navigateur";
				if (eregi("doris/1.10",$this->_userAgent)) {$this->_browserVersion = "1.10";}
			}
			elseif (eregi("emacs",$this->_userAgent))
			{
				$this->_browser = "Emacs";
				$this->_type = "Navigateur";
				if (eregi("emacs/w3/2",$this->_userAgent)) {$this->_browserVersion = "2";}
				elseif (eregi("emacs/w3/3",$this->_userAgent)) {$this->_browserVersion = "3";}
				elseif (eregi("emacs/w3/4",$this->_userAgent)) {$this->_browserVersion = "4";}
			}
			elseif (eregi("firebird",$this->_userAgent))
			{
				$this->_browser = "Firebird";
				$this->_type = "Navigateur";
				if ((eregi("firebird/0.6",$this->_userAgent)) || (eregi("_browser/0.6",$this->_userAgent))) {$this->_browserVersion = "0.6";}
				elseif (eregi("firebird/0.7",$this->_userAgent)) {$this->_browserVersion = "0.7";}
			}
			elseif (eregi("firefox",$this->_userAgent))
			{
				$this->_browser = "Firefox";
				$this->_type = "Navigateur";
				if (eregi("Firefox/3",$this->_userAgent)) {$this->_browserVersion = "3.x";}
				elseif (eregi("Firefox/2",$this->_userAgent)) {$this->_browserVersion = "2.x";}
				elseif (eregi("firefox/1.",$this->_userAgent)) {$this->_browserVersion = "1.x";}
				elseif (eregi("firefox/0.",$this->_userAgent)) {$this->_browserVersion = "0.x";}
			}
			elseif (eregi("frontpage",$this->_userAgent))
			{
				$this->_browser = "FrontPage";
				$this->_type = "Navigateur";
				if ((eregi("express 2",$this->_userAgent)) || (eregi("frontpage 2",$this->_userAgent))) {$this->_browserVersion = "2";}
				elseif (eregi("frontpage 3",$this->_userAgent)) {$this->_browserVersion = "3";}
				elseif (eregi("frontpage 4",$this->_userAgent)) {$this->_browserVersion = "4";}
				elseif (eregi("frontpage 5",$this->_userAgent)) {$this->_browserVersion = "5";}
				elseif (eregi("frontpage 6",$this->_userAgent)) {$this->_browserVersion = "6";}
			}
			elseif (eregi("galeon",$this->_userAgent))
			{
				$this->_browser = "Galeon";
				$this->_type = "Navigateur";
				if (eregi("galeon 0.1",$this->_userAgent)) {$this->_browserVersion = "0.1";}
				elseif (eregi("galeon/0.11.1",$this->_userAgent)) {$this->_browserVersion = "0.11.1";}
				elseif (eregi("galeon/0.11.2",$this->_userAgent)) {$this->_browserVersion = "0.11.2";}
				elseif (eregi("galeon/0.11.3",$this->_userAgent)) {$this->_browserVersion = "0.11.3";}
				elseif (eregi("galeon/0.11.5",$this->_userAgent)) {$this->_browserVersion = "0.11.5";}
				elseif (eregi("galeon/0.12.8",$this->_userAgent)) {$this->_browserVersion = "0.12.8";}
				elseif (eregi("galeon/0.12.7",$this->_userAgent)) {$this->_browserVersion = "0.12.7";}
				elseif (eregi("galeon/0.12.6",$this->_userAgent)) {$this->_browserVersion = "0.12.6";}
				elseif (eregi("galeon/0.12.5",$this->_userAgent)) {$this->_browserVersion = "0.12.5";}
				elseif (eregi("galeon/0.12.4",$this->_userAgent)) {$this->_browserVersion = "0.12.4";}
				elseif (eregi("galeon/0.12.3",$this->_userAgent)) {$this->_browserVersion = "0.12.3";}
				elseif (eregi("galeon/0.12.2",$this->_userAgent)) {$this->_browserVersion = "0.12.2";}
				elseif (eregi("galeon/0.12.1",$this->_userAgent)) {$this->_browserVersion = "0.12.1";}
				elseif (eregi("galeon/0.12",$this->_userAgent)) {$this->_browserVersion = "0.12";}
				elseif ((eregi("galeon/1",$this->_userAgent)) || (eregi("galeon 1.0",$this->_userAgent))) {$this->_browserVersion = "1.0";}
			}
			elseif (eregi("ibm web _browser",$this->_userAgent))
			{
				$this->_browser = "IBM Web _browser";
				$this->_type = "Navigateur";
				if (eregi("rv:1.0.1",$this->_userAgent)) {$this->_browserVersion = "1.0.1";}
			}
			elseif (eregi("chimera",$this->_userAgent))
			{
				$this->_browser = "Chimera";
				$this->_type = "Navigateur";
				if (eregi("chimera/0.7",$this->_userAgent)) {$this->_browserVersion = "0.7";}
				elseif (eregi("chimera/0.6",$this->_userAgent)) {$this->_browserVersion = "0.6";}
				elseif (eregi("chimera/0.5",$this->_userAgent)) {$this->_browserVersion = "0.5";}
				elseif (eregi("chimera/0.4",$this->_userAgent)) {$this->_browserVersion = "0.4";}
			}
			elseif (eregi("icab",$this->_userAgent))
			{
				$this->_browser = "iCab";
        		$this->_type = "Navigateur";
				if (eregi("icab/2.7.1",$this->_userAgent)) {$this->_browserVersion = "2.7.1";}
				elseif (eregi("icab/2.8.1",$this->_userAgent)) {$this->_browserVersion = "2.8.1";}
				elseif (eregi("icab/2.8.2",$this->_userAgent)) {$this->_browserVersion = "2.8.2";}
				elseif (eregi("icab 2.9",$this->_userAgent)) {$this->_browserVersion = "2.9";}
				elseif (eregi("icab 2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
			elseif (eregi("konqueror",$this->_userAgent))
			{
				$this->_browser = "Konqueror";
				$this->_type = "Navigateur";
				if (eregi("konqueror/3.1",$this->_userAgent)) {$this->_browserVersion = "3.1";}
				elseif (eregi("konqueror/3.3",$this->_userAgent)) {$this->_browserVersion = "3.3";}
				elseif (eregi("konqueror/3.2",$this->_userAgent)) {$this->_browserVersion = "3.2";}
				elseif (eregi("konqueror/3",$this->_userAgent)) {$this->_browserVersion = "3.0";}
				elseif (eregi("konqueror/2.2",$this->_userAgent)) {$this->_browserVersion = "2.2";}
				elseif (eregi("konqueror/2.1",$this->_userAgent)) {$this->_browserVersion = "2.1";}
				elseif (eregi("konqueror/1.1",$this->_userAgent)) {$this->_browserVersion = "1.1";}
			}
			elseif (eregi("liberate",$this->_userAgent))
			{
				$this->_browser = "Liberate";
				$this->_type = "Navigateur";
				if (eregi("dtv 1.2",$this->_userAgent)) {$this->_browserVersion = "1.2";}
				elseif (eregi("dtv 1.1",$this->_userAgent)) {$this->_browserVersion = "1.1";}
			}
			elseif (eregi("desktop/lx",$this->_userAgent))
			{
				$this->_browser = "Lycoris Desktop/LX";
				$this->_type = "Navigateur";
			}
			elseif (eregi("netbox",$this->_userAgent))
			{
				$this->_browser = "NetBox";
				$this->_type = "Navigateur";
				if (eregi("netbox/3.5",$this->_userAgent)) {$this->_browserVersion = "3.5";}
			}
			elseif (eregi("netcaptor",$this->_userAgent))
			{
				$this->_browser = "Netcaptor";
				$this->_type = "Navigateur";
				if (eregi("netcaptor 7.0",$this->_userAgent)) {$this->_browserVersion = "7.0";}
				elseif (eregi("netcaptor 7.1",$this->_userAgent)) {$this->_browserVersion = "7.1";}
				elseif (eregi("netcaptor 7.2",$this->_userAgent)) {$this->_browserVersion = "7.2";}
				elseif (eregi("netcaptor 7.5",$this->_userAgent)) {$this->_browserVersion = "7.5";}
				elseif (eregi("netcaptor 6.1",$this->_userAgent)) {$this->_browserVersion = "6.1";}
			}
			elseif (eregi("netpliance",$this->_userAgent))
			{
				$this->_browser = "Netpliance";
				$this->_type = "Navigateur";
			}
			elseif (eregi("netscape",$this->_userAgent)) // (1) netscape nie je prilis detekovatelny....
			{
				$this->_browser = "Netscape";
				$this->_type = "Navigateur";
				if (eregi("netscape/7.1",$this->_userAgent)) {$this->_browserVersion = "7.1";}
				elseif (eregi("netscape/7.2",$this->_userAgent)) {$this->_browserVersion = "7.2";}
				elseif (eregi("netscape/7.0",$this->_userAgent)) {$this->_browserVersion = "7.0";}
				elseif (eregi("netscape6/6.2",$this->_userAgent)) {$this->_browserVersion = "6.2";}
				elseif (eregi("netscape6/6.1",$this->_userAgent)) {$this->_browserVersion = "6.1";}
				elseif (eregi("netscape6/6.0",$this->_userAgent)) {$this->_browserVersion = "6.0";}
			}
			elseif ((eregi("mozilla/5.0",$this->_userAgent)) && (eregi("rv:",$this->_userAgent)) && (eregi("gecko/",$this->_userAgent))) // mozilla je tr_oschu zlozitejsia na detekciu
			{
				$this->_browser = "Mozilla";
				$this->_type = "Navigateur";
				if (eregi("rv:1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
				elseif (eregi("rv:1.1",$this->_userAgent)) {$this->_browserVersion = "1.1";}
				elseif (eregi("rv:1.2",$this->_userAgent)) {$this->_browserVersion = "1.2";}
				elseif (eregi("rv:1.3",$this->_userAgent)) {$this->_browserVersion = "1.3";}
				elseif (eregi("rv:1.4",$this->_userAgent)) {$this->_browserVersion = "1.4";}
				elseif (eregi("rv:1.5",$this->_userAgent)) {$this->_browserVersion = "1.5";}
				elseif (eregi("rv:1.6",$this->_userAgent)) {$this->_browserVersion = "1.6";}
				elseif (eregi("rv:1.7",$this->_userAgent)) {$this->_browserVersion = "1.7";}
				elseif (eregi("rv:1.8",$this->_userAgent)) {$this->_browserVersion = "1.8";}
			}
			elseif (eregi("offbyone",$this->_userAgent))
			{
				$this->_browser = "OffByOne";
				$this->_type = "Navigateur";
				if (eregi("mozilla/4.7",$this->_userAgent)) {$this->_browserVersion = "3.4";}
			}
			elseif (eregi("omniweb",$this->_userAgent))
			{
				$this->_browser = "OmniWeb";
				$this->_type = "Navigateur";
				if (eregi("omniweb/4.5",$this->_userAgent)) {$this->_browserVersion = "4.5";}
				elseif (eregi("omniweb/4.4",$this->_userAgent)) {$this->_browserVersion = "4.4";}
				elseif (eregi("omniweb/4.3",$this->_userAgent)) {$this->_browserVersion = "4.3";}
				elseif (eregi("omniweb/4.2",$this->_userAgent)) {$this->_browserVersion = "4.2";}
				elseif (eregi("omniweb/4.1",$this->_userAgent)) {$this->_browserVersion = "4.1";}
			}
			elseif (eregi("opera",$this->_userAgent))
			{ 
				$this->_browser = "Opera";
				$this->_type = "Navigateur";
				if ((eregi("opera/9",$this->_userAgent)) || (eregi("opera 8.0",$this->_userAgent))) {$this->_browserVersion = "9";}
				elseif ((eregi("opera/8",$this->_userAgent)) || (eregi("opera 8.0",$this->_userAgent))) {$this->_browserVersion = "8";}
				elseif ((eregi("opera/7",$this->_userAgent)) || (eregi("opera 7.60",$this->_userAgent))) {$this->_browserVersion = "7";}
				elseif ((eregi("opera/6",$this->_userAgent)) || (eregi("opera 6.12",$this->_userAgent))) {$this->_browserVersion = "6";}
				elseif ((eregi("opera/5",$this->_userAgent)) || (eregi("opera 5.12",$this->_userAgent))) {$this->_browserVersion = "5";}
				elseif ((eregi("opera/4",$this->_userAgent)) || (eregi("opera 4",$this->_userAgent))) {$this->_browserVersion = "4";}
			}
			elseif (eregi("oracle",$this->_userAgent))
			{
				$this->_browser = "Oracle Power_browser";
				$this->_type = "Navigateur";
				if (eregi("(tm)/1.0a",$this->_userAgent)) {$this->_browserVersion = "1.0a";}
				elseif (eregi("oracle 1.5",$this->_userAgent)) {$this->_browserVersion = "1.5";}
			}
			elseif (eregi("phoenix",$this->_userAgent))
			{
				$this->_browser = "Phoenix";
				$this->_type = "Navigateur";
				if (eregi("phoenix/0.4",$this->_userAgent)) {$this->_browserVersion = "0.4";}
				elseif (eregi("phoenix/0.5",$this->_userAgent)) {$this->_browserVersion = "0.5";}
			}
			elseif (eregi("planetweb",$this->_userAgent))
			{
				$this->_browser = "PlanetWeb";
				$this->_type = "Navigateur";
				if (eregi("planetweb/2.606",$this->_userAgent)) {$this->_browserVersion = "2.6";}
				elseif (eregi("planetweb/1.125",$this->_userAgent)) {$this->_browserVersion = "3";}
			}
			elseif (eregi("powertv",$this->_userAgent))
			{
				$this->_browser = "PowerTV";
				$this->_type = "Navigateur";
				if (eregi("powertv/1.5",$this->_userAgent)) {$this->_browserVersion = "1.5";}
			}
			elseif (eregi("prodigy",$this->_userAgent))
			{
				$this->_browser = "Prodigy";
				$this->_type = "Navigateur";
				if (eregi("wb/3.2e",$this->_userAgent)) {$this->_browserVersion = "3.2e";}
				elseif (eregi("rv: 1.",$this->_userAgent)) {$this->_browserVersion = "1.0";}
			}
			elseif ((eregi("voyager",$this->_userAgent)) || ((eregi("qnx",$this->_userAgent))) && (eregi("rv: 1.",$this->_userAgent))) // aj voyager je tr_osku zlozitejsi na detekciu
			{
				$this->_browser = "Voyager";
        $this->_type = "Navigateur";
				if (eregi("2.03b",$this->_userAgent)) {$this->_browserVersion = "2.03b";}
				elseif (eregi("wb/win32/3.4g",$this->_userAgent)) {$this->_browserVersion = "3.4g";}
			}
			elseif (eregi("quicktime",$this->_userAgent))
			{
				$this->_browser = "QuickTime";
				$this->_type = "Navigateur";
				if (eregi("qtver=5",$this->_userAgent)) {$this->_browserVersion = "5.0";}
				elseif (eregi("qtver=6.0",$this->_userAgent)) {$this->_browserVersion = "6.0";}
				elseif (eregi("qtver=6.1",$this->_userAgent)) {$this->_browserVersion = "6.1";}
				elseif (eregi("qtver=6.2",$this->_userAgent)) {$this->_browserVersion = "6.2";}
				elseif (eregi("qtver=6.3",$this->_userAgent)) {$this->_browserVersion = "6.3";}
				elseif (eregi("qtver=6.4",$this->_userAgent)) {$this->_browserVersion = "6.4";}
				elseif (eregi("qtver=6.5",$this->_userAgent)) {$this->_browserVersion = "6.5";}
			}
			elseif (eregi("safari",$this->_userAgent))
			{
				$this->_browser = "Safari";
				$this->_type = "Navigateur";
				if (eregi("safari/48",$this->_userAgent)) {$this->_browserVersion = "0.48";}
				elseif (eregi("safari/49",$this->_userAgent)) {$this->_browserVersion = "0.49";}
				elseif (eregi("safari/51",$this->_userAgent)) {$this->_browserVersion = "0.51";}
				elseif (eregi("safari/60",$this->_userAgent)) {$this->_browserVersion = "0.60";}
				elseif (eregi("safari/61",$this->_userAgent)) {$this->_browserVersion = "0.61";}
				elseif (eregi("safari/62",$this->_userAgent)) {$this->_browserVersion = "0.62";}
				elseif (eregi("safari/63",$this->_userAgent)) {$this->_browserVersion = "0.63";}
				elseif (eregi("safari/64",$this->_userAgent)) {$this->_browserVersion = "0.64";}
				elseif (eregi("safari/65",$this->_userAgent)) {$this->_browserVersion = "0.65";}
				elseif (eregi("safari/66",$this->_userAgent)) {$this->_browserVersion = "0.66";}
				elseif (eregi("safari/67",$this->_userAgent)) {$this->_browserVersion = "0.67";}
				elseif (eregi("safari/68",$this->_userAgent)) {$this->_browserVersion = "0.68";}
				elseif (eregi("safari/69",$this->_userAgent)) {$this->_browserVersion = "0.69";}
				elseif (eregi("safari/70",$this->_userAgent)) {$this->_browserVersion = "0.70";}
				elseif (eregi("safari/71",$this->_userAgent)) {$this->_browserVersion = "0.71";}
				elseif (eregi("safari/72",$this->_userAgent)) {$this->_browserVersion = "0.72";}
				elseif (eregi("safari/73",$this->_userAgent)) {$this->_browserVersion = "0.73";}
				elseif (eregi("safari/74",$this->_userAgent)) {$this->_browserVersion = "0.74";}
				elseif (eregi("safari/80",$this->_userAgent)) {$this->_browserVersion = "0.80";}
				elseif (eregi("safari/83",$this->_userAgent)) {$this->_browserVersion = "0.83";}
				elseif (eregi("safari/84",$this->_userAgent)) {$this->_browserVersion = "0.84";}
				elseif (eregi("safari/85",$this->_userAgent)) {$this->_browserVersion = "0.85";}
				elseif (eregi("safari/90",$this->_userAgent)) {$this->_browserVersion = "0.90";}
				elseif (eregi("safari/92",$this->_userAgent)) {$this->_browserVersion = "0.92";}
				elseif (eregi("safari/93",$this->_userAgent)) {$this->_browserVersion = "0.93";}
				elseif (eregi("safari/94",$this->_userAgent)) {$this->_browserVersion = "0.94";}
				elseif (eregi("safari/95",$this->_userAgent)) {$this->_browserVersion = "0.95";}
				elseif (eregi("safari/96",$this->_userAgent)) {$this->_browserVersion = "0.96";}
				elseif (eregi("safari/97",$this->_userAgent)) {$this->_browserVersion = "0.97";}
				elseif (eregi("safari/125",$this->_userAgent)) {$this->_browserVersion = "1.25";}
			}
			elseif (eregi("sextatnt",$this->_userAgent))
			{
				$this->_browser = "Tango";
				$this->_type = "Navigateur";
				if (eregi("sextant v3.0",$this->_userAgent)) {$this->_browserVersion = "3.0";}
			}
			elseif (eregi("sharpreader",$this->_userAgent))
			{
				$this->_browser = "SharpReader";
				$this->_type = "Navigateur";
				if (eregi("sharpreader/0.9.5",$this->_userAgent)) {$this->_browserVersion = "0.9.5";}
			}
			elseif (eregi("elinks",$this->_userAgent))
			{
				$this->_browser = "ELinks";
				$this->_type = "Navigateur";
				if (eregi("0.3",$this->_userAgent)) {$this->_browserVersion = "0.3";}
				elseif (eregi("0.4",$this->_userAgent)) {$this->_browserVersion = "0.4";}
				elseif (eregi("0.9",$this->_userAgent)) {$this->_browserVersion = "0.9";}
			}
			elseif (eregi("links",$this->_userAgent))
			{
				$this->_browser = "Links";
				$this->_type = "Navigateur";
				if (eregi("0.9",$this->_userAgent)) {$this->_browserVersion = "0.9";}
				elseif (eregi("2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
				elseif (eregi("2.1",$this->_userAgent)) {$this->_browserVersion = "2.1";}
			}
			elseif (eregi("lynx",$this->_userAgent))
			{
				$this->_browser = "Lynx";
				$this->_type = "Navigateur";
				if (eregi("lynx/2.3",$this->_userAgent)) {$this->_browserVersion = "2.3";}
				elseif (eregi("lynx/2.4",$this->_userAgent)) {$this->_browserVersion = "2.4";}
				elseif ((eregi("lynx/2.5",$this->_userAgent)) || (eregi("lynx 2.5",$this->_userAgent))) {$this->_browserVersion = "2.5";}
				elseif (eregi("lynx/2.6",$this->_userAgent)) {$this->_browserVersion = "2.6";}
				elseif (eregi("lynx/2.7",$this->_userAgent)) {$this->_browserVersion = "2.7";}
				elseif (eregi("lynx/2.8",$this->_userAgent)) {$this->_browserVersion = "2.8";}
			}
			elseif (eregi("webexplorer",$this->_userAgent))
			{
				$this->_browser = "WebExplorer";
				$this->_type = "Navigateur";
				if (eregi("dll/v1.1",$this->_userAgent)) {$this->_browserVersion = "1.1";}
			}
			elseif (eregi("wget",$this->_userAgent))
			{
				$this->_browser = "WGet";
				$this->_type = "Navigateur";
				if (eregi("Wget/1.9",$this->_userAgent)) {$this->_browserVersion = "1.9";}
				if (eregi("Wget/1.8",$this->_userAgent)) {$this->_browserVersion = "1.8";}
			}
			elseif (eregi("webtv",$this->_userAgent))
			{
				$this->_browser = "WebTV";
				$this->_type = "Navigateur";
				if (eregi("webtv/1.0",$this->_userAgent)) {$this->_browserVersion = "1.0";}
				elseif (eregi("webtv/1.1",$this->_userAgent)) {$this->_browserVersion = "1.1";}
				elseif (eregi("webtv/1.2",$this->_userAgent)) {$this->_browserVersion = "1.2";}
				elseif (eregi("webtv/2.2",$this->_userAgent)) {$this->_browserVersion = "2.2";}
				elseif (eregi("webtv/2.5",$this->_userAgent)) {$this->_browserVersion = "2.5";}
				elseif (eregi("webtv/2.6",$this->_userAgent)) {$this->_browserVersion = "2.6";}
				elseif (eregi("webtv/2.7",$this->_userAgent)) {$this->_browserVersion = "2.7";}
			}
			elseif (eregi("yandex",$this->_userAgent))
			{
				$this->_browser = "Yandex";
				$this->_type = "Navigateur";
				if (eregi("/1.01",$this->_userAgent)) {$this->_browserVersion = "1.01";}
				elseif (eregi("/1.03",$this->_userAgent)) {$this->_browserVersion = "1.03";}
			}
			elseif ((eregi("mspie",$this->_userAgent)) || ((eregi("msie",$this->_userAgent))) && (eregi("windows ce",$this->_userAgent)))
			{
				$this->_browser = "Pocket Internet Explorer";
				$this->_type = "Navigateur";
				if (eregi("mspie 1.1",$this->_userAgent)) {$this->_browserVersion = "1.1";}
				elseif (eregi("mspie 2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
				elseif (eregi("msie 3.02",$this->_userAgent)) {$this->_browserVersion = "3.02";}
			}
			elseif (eregi("UP._browser/",$this->_userAgent))
			{
				$this->_browser = "UP _browser";
				$this->_type = "Navigateur";
				if (eregi("_browser/7.0",$this->_userAgent)) {$this->_browserVersion = "7.0";}
			}
			elseif (eregi("msie",$this->_userAgent))
			{
				$this->_browser = "Internet Explorer";
				$this->_type = "Navigateur";

				if (eregi("msie 8.0",$this->_userAgent)) {$this->_browserVersion = "8.0";}
                elseif (eregi("msie 7.0",$this->_userAgent)) {$this->_browserVersion = "7.0";}
				elseif (eregi("msie 6.0",$this->_userAgent)) {$this->_browserVersion = "6.0";}
				elseif (eregi("msie 5.5",$this->_userAgent)) {$this->_browserVersion = "5.5";}
				elseif (eregi("msie 5.01",$this->_userAgent)) {$this->_browserVersion = "5.01";}
				elseif (eregi("msie 5.23",$this->_userAgent)) {$this->_browserVersion = "5.23";}
				elseif (eregi("msie 5.22",$this->_userAgent)) {$this->_browserVersion = "5.22";}
				elseif (eregi("msie 5.2.2",$this->_userAgent)) {$this->_browserVersion = "5.2.2";}
				elseif (eregi("msie 5.1b1",$this->_userAgent)) {$this->_browserVersion = "5.1b1";}
				elseif (eregi("msie 5.17",$this->_userAgent)) {$this->_browserVersion = "5.17";}
				elseif (eregi("msie 5.16",$this->_userAgent)) {$this->_browserVersion = "5.16";}
				elseif (eregi("msie 5.12",$this->_userAgent)) {$this->_browserVersion = "5.12";}
				elseif (eregi("msie 5.0b1",$this->_userAgent)) {$this->_browserVersion = "5.0b1";}
				elseif (eregi("msie 5.0",$this->_userAgent)) {$this->_browserVersion = "5.0";}
				elseif (eregi("msie 5.21",$this->_userAgent)) {$this->_browserVersion = "5.21";}
				elseif (eregi("msie 5.2",$this->_userAgent)) {$this->_browserVersion = "5.2";}
				elseif (eregi("msie 5.15",$this->_userAgent)) {$this->_browserVersion = "5.15";}
				elseif (eregi("msie 5.14",$this->_userAgent)) {$this->_browserVersion = "5.14";}
				elseif (eregi("msie 5.13",$this->_userAgent)) {$this->_browserVersion = "5.13";}
				elseif (eregi("msie 4.5",$this->_userAgent)) {$this->_browserVersion = "4.5";}
				elseif (eregi("msie 4.01",$this->_userAgent)) {$this->_browserVersion = "4.01";}
				elseif (eregi("msie 4.0b2",$this->_userAgent)) {$this->_browserVersion = "4.0b2";}
				elseif (eregi("msie 4.0b1",$this->_userAgent)) {$this->_browserVersion = "4.0b1";}
				elseif (eregi("msie 4",$this->_userAgent)) {$this->_browserVersion = "4.0";}
				elseif (eregi("msie 3",$this->_userAgent)) {$this->_browserVersion = "3.0";}
				elseif (eregi("msie 2",$this->_userAgent)) {$this->_browserVersion = "2.0";}
				elseif (eregi("msie 1.5",$this->_userAgent)) {$this->_browserVersion = "1.5";}
			}
			elseif (eregi("iexplore",$this->_userAgent))
			{
				$this->_browser = "Internet Explorer";
				$this->_type = "Navigateur";
			}
			elseif (eregi("mozilla",$this->_userAgent)) // (2) netscape nie je prilis detekovatelny....
			{
				$this->_browser = "Netscape";
				$this->_type = "Navigateur";
				if (eregi("mozilla/4.8",$this->_userAgent)) {$this->_browserVersion = "4.8";}
				elseif (eregi("mozilla/4.7",$this->_userAgent)) {$this->_browserVersion = "4.7";}
				elseif (eregi("mozilla/4.6",$this->_userAgent)) {$this->_browserVersion = "4.6";}
				elseif (eregi("mozilla/4.5",$this->_userAgent)) {$this->_browserVersion = "4.5";}
				elseif (eregi("mozilla/4.0",$this->_userAgent)) {$this->_browserVersion = "4.0";}
				elseif (eregi("mozilla/3.0",$this->_userAgent)) {$this->_browserVersion = "3.0";}
				elseif (eregi("mozilla/2.0",$this->_userAgent)) {$this->_browserVersion = "2.0";}
			}
		}
	}
