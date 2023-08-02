CREATE TRIGGER `editpoin` AFTER UPDATE ON `poin`
 FOR EACH ROW BEGIN
	UPDATE tb_siswa SET tb_siswa.poin = tb_siswa.poin + OLD.poin - NEW.poin
    WHERE id = OLD.id_siswa;
END


CREATE TRIGGER `haapuspoin` AFTER DELETE ON `poin`
 FOR EACH ROW BEGIN
	UPDATE tb_siswa SET poin = poin + OLD.poin
    WHERE id = OLD.id_siswa;
END


CREATE TRIGGER `tambahpoin` AFTER INSERT ON `poin`
 FOR EACH ROW BEGIN
	UPDATE tb_siswa SET poin = poin - NEW.poin
    WHERE id = NEW.id_siswa;
END